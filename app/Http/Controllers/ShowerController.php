<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\ShowerHistory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;


class ShowerController extends Controller
{
    public function index(Request $request) {
        $name = $request->input('name');
        $plant = Plant::where('slug', $name)->first();

        if ($request->input('action') == 'turn-on'){
            $checkSafety = ShowerHistory::where('plant_id', $plant->id)->where('is_active', true)->first();
            if ($checkSafety){
                return response()->json([
                   'success' => false,
                   'message' => 'Tanaman sedang dalam penyiraman. Lihat riwayat penyiraman',
                ], 422);
            }

            $historyData = [
                'plant_id' => $plant->id,
                'actived_by' => auth()->user()->id,
                'is_active' => true,
                'is_actived_by_system' => false,
                'soil_before' => $plant->soil,
                'temp_before' => $plant->temp,
                'air_before' => $plant->air,
                'air_before' => $plant->air,
                'shower_on' => now(),
            ];
            
            try {
                $plant->trigger_shower = true;
                $plant->updated_at = now();
                $plant->save();
                ShowerHistory::create($historyData);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil mengirimkan perintah, Ini membutuhkan beberapa waktu untuk ESP merespon',
                ]);
            }catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat melakukan penyiraman. Periksa riwayat penyiraman apakah ada orang lain yang melakukan aksi yang sama dalam waktu bersamaan',
                    'error' => $e->getMessage(),
                ], 422);
            }
            

            
        } elseif ($request->input('action') == 'turn-off') {
            $checkSafety = ShowerHistory::where('plant_id', $plant->id)->where('is_active', true)->first();
            if (!$checkSafety){
                return response()->json([
                   'success' => false,
                   'message' => 'Tanaman harus keadaan menyiram jika ingin dimatikan. Lihat riwayat penyiraman',
                ], 422);
            }
            
            try {
                $plant->trigger_shower = false;
                $plant->updated_at = now();
                $plant->save();
                $checkSafety->is_active = false;
                $checkSafety->is_deactived_by_system = false;
                $checkSafety->deactived_by = auth()->user()->id;
                $checkSafety->soil_after = $plant->soil;
                $checkSafety->temp_after = $plant->temp;
                $checkSafety->air_after = $plant->air;
                $checkSafety->shower_off = now();
                $showerOn = Carbon::parse($checkSafety->shower_on);
                $showerOff = Carbon::parse($checkSafety->shower_off);
                $checkSafety->shower_diff = $showerOn->diff($showerOff);
                $checkSafety->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil mengirimkan perintah, Ini membutuhkan beberapa waktu untuk ESP merespon',
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat melakukan penyiraman. Periksa riwayat penyiraman apakah ada orang lain yang melakukan aksi yang sama dalam waktu bersamaan',
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }


    public function history($history) {
        $history = ShowerHistory::where('id', $history)->first();
        $plant = $history->plant->name;
        $title = "Riwayat penyiraman tanaman " . $history->plant->name;

        return view('plants.showerHistory', compact('history', 'plant', 'title'));
    }

    public function APIViewHistory($shower) {
        $history = ShowerHistory::where('id', $shower)->with('plant:id,name', 'activatedBy:id,name,email')->first();

        $history->soil_before_percent = intval(($history->soil_before/4095)*100) ;
        $history->soil_after_percent = intval(($history->soil_after/4095)*100) ;
        $history->fahrenheit_before = intval( $history->temp_before * 9/5 ) + 32;
        $history->fahrenheit_after = intval( $history->temp_after * 9/5 ) + 32;
        
        return view('plants.partials.showShowerHistory', compact('history'));
    }
}