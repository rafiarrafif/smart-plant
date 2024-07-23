<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\ShowerHistory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class APIController extends Controller
{
    public function allIndex() {
        $data = Plant::select('name', 'slug', 'status', 'air', 'soil', 'temp', 'last_connection')->get()->map(function ($plant){
            $plant->temp = intval($plant->temp); 
            $plant->updated_at_carbon = $plant->status == 'active' ? 'Terakhir diperbarui ' . Carbon::parse($plant->last_connection)->diffForHumans() : "Belum pernah terhubung dengan perangkat ESP";
            return $plant;
        });

        foreach ($data as $plant) {
            if ($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->last_connection)) < -30){
                $statuses[] = 'inactive';
            } elseif($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->last_connection)) > -30){
                $statuses[] = 'active';
            } elseif($plant->status == 'pending') {
                $statuses[] = 'pending';
            }
        }
        return response()->json([
            'plants' => $data,
            'statuses' => $statuses
        ]);
    }

    public function plantIndex(Plant $plant) {
        unset(
            $plant->id, 
            $plant->keystream,
            $plant->auto_shower_status,   
            $plant->auto_shower_time,   
            $plant->auto_shower_timer,   
            $plant->settings_timer_max,   
            $plant->settings_type_off,   
            $plant->settings_value_off,   
        );
        
        $plant->celcius = intval($plant->temp);
        $plant->fahrenheit = intval( intval($plant->temp) * 9/5 ) + 32;
        $plant->reamur = intval( intval($plant->temp) * 4/5 );
        $plant->kelvin = intval( intval($plant->temp) + 273,15 );
        $plant->soilPercent = intval( ($plant->soil/4095)*100 );
        $plant->lastUpdated = Carbon::parse($plant->last_connection)->diffForHumans();

        if ($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->last_connection)) < -30){
            $plant->connection = 'Terputus';
        } elseif($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->last_connection)) > -30){
            $plant->connection = 'Terhubung';
        } elseif($plant->status == 'pending') {
            $plant->connection = 'pending';
        }

        return response()->json([
            "plant" => $plant
        ]);
    }

    public function updateData($id, $keystream, $air, $soil, $temp, $shower){
        $data = Plant::where('id', $id)->first();
        $systemShowering = null;

        if ($data) {
            $update = [
                "id" => $id,
                "air" => $air,
                "soil" => $soil,
                "temp" => $temp,
                "callback_shower" => $shower,
                "status" => "active",
                "last_connection" => now()
            ];
            
            if ($keystream != $data->keystream){
                return response("error: keystream not match");
            }
            
            if ($data->auto_shower_status == true ) {
                $historyCheckAutoShower = ShowerHistory::where('plant_id', $data->id)->where('is_active', true)->where('is_actived_by_system' ,true)->first();
                if ($historyCheckAutoShower) {
                    $timeStart = Carbon::parse($historyCheckAutoShower->created_at);
                    $timeNow = Carbon::now();
                    $diffAutoShower = $timeStart->diffInSeconds($timeNow);
                    if($diffAutoShower >= $data->auto_shower_timer){
                        $historyCheckAutoShower->is_active = false;
                        $historyCheckAutoShower->is_deactived_by_system = true;
                        $historyCheckAutoShower->soil_after = $data->soil;
                        $historyCheckAutoShower->temp_after = $data->temp;
                        $historyCheckAutoShower->air_after = $data->air;
                        $historyCheckAutoShower->shower_off = now();
                        $showerOn = Carbon::parse($historyCheckAutoShower->shower_on);
                        $showerOff = Carbon::parse($historyCheckAutoShower->shower_off);
                        $historyCheckAutoShower->shower_diff = $showerOn->diff($showerOff);
                        $historyCheckAutoShower->save();
                        $data->trigger_shower = false;
                    }
                } else {
                    $showerTime = Carbon::createFromFormat('H:i:s', $data->auto_shower_time);
                    $nowTime = Carbon::now();
                    $currentHour = $nowTime->format('H');
                    $currentMinute = $nowTime->format('i'); 
                    $match = ShowerHistory::whereRaw('HOUR(created_at) = ?', [$currentHour])
                        ->whereRaw('MINUTE(created_at) = ?', [$currentMinute])
                        ->first();

                    if(!$match && $showerTime->hour == $nowTime->hour && $showerTime->minute == $nowTime->minute){
                        $autoHistory = [
                            'plant_id' => $data->id,
                            'is_active' => true,
                            'is_actived_by_system' => true,
                            'soil_before' => $data->soil,
                            'temp_before' => $data->temp,
                            'air_before' => $data->air,
                            'air_before' => $data->air,
                            'shower_on' => now(),
                        ];
                        $createShower = ShowerHistory::create($autoHistory);
                        $data->trigger_shower = true;
                    }
                }
            }
            
            if ($data->is_settings_prefer == true && $data->trigger_shower == true) {
                $history = ShowerHistory::where('plant_id', $data->id)->where('is_active', true)->first();
                $differenceInSeconds = Carbon::now()->diffInSeconds($history->last_connection);
                $settingsParam = $data->settings_type_off;
                $settingsValue = $data->settings_value_off;
                $stateValue = $data->$settingsParam;

                if($settingsParam == 'temp'){
                    $systemShowering = ($stateValue <= $settingsValue) || ($differenceInSeconds <= -$data->settings_timer_max) ?  'off' : null;
                }else {
                    $systemShowering = ($stateValue >= $settingsValue) || ($differenceInSeconds <= -$data->settings_timer_max) ?  'off' : null;
                }
            } 
            
            try{
                $userShowering = $data->trigger_shower == true ? 'shower_on' : 'shower_off';
                switch ($systemShowering){
                    case 'off':
                        $history->is_active = false;
                        $history->is_deactived_by_system = true;
                        $history->soil_after = $data->soil;
                        $history->temp_after = $data->temp;
                        $history->air_after = $data->air;
                        $history->shower_off = now();
                        $showerOn = Carbon::parse($history->shower_on);
                        $showerOff = Carbon::parse($history->shower_off);
                        $history->shower_diff = $showerOn->diff($showerOff);
                        $history->save();

                        $data->trigger_shower = false;
                        $data->update($update);
                        return response('shower_off');
                        break;
                    case null:
                        $data->update($update);
                        return response($userShowering);
                        break;
                }
            } catch(Exception $e) {
                return response($e);
            }
        

        } else {
            return response("error: id driver not found");
        }
    }

    public function showerHistory($plant) {
        $history = Plant::where('slug', $plant)->select('id')->with('showerHistory:id,plant_id,actived_by,is_active,shower_diff,created_at', 'showerHistory.activatedBy:id,name')->first();
        // return $history;
        return view('plants.partials.showerHistory', compact('history'));
    }
}