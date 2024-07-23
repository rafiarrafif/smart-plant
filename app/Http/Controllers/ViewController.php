<?php

namespace App\Http\Controllers;

use App\Models\DataSensor;
use App\Models\Logging;
use App\Models\Plant;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class ViewController extends Controller
{
    public function index() {
        $plants = Plant::all();
        $statuses = [];
        foreach ($plants as $plant) {   
            if ($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->updated_at)) < -30){
                $statuses[] = 'inactive';
            } elseif($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->updated_at)) > -30){
                $statuses[] = 'active';
            } elseif($plant->status == 'pending') {
                $statuses[] = 'pending';
            }
        }
        return view('home.index', compact('plants', 'statuses'));
    }

    public function logIndex(){
        $logs = Logging::all()->sortByDesc('created_at');
        return view('log.index', compact('logs'));
    }
    public function logShow($log){
        $loging = Logging::where('id', $log)->first();
        return view('log.show', compact('loging'));
    }
    
    public function pending() {
        if (!auth()->user() || auth()->user()->role != 'pending') {
            return redirect()->route('home');
        }
        return view('welcome.pending');
    }

    public function getData() {
        $data = DataSensor::where('id', 1)->first();
        return response()->json($data);
    }

    public function createPlantSuccess(Plant $plant){
        if(!session('view_token_plant')){
            return redirect()->route('home');
        }

        return view('plant.successCreate', compact($plant));
    }

    public function frezee(){
        $stats = AppSettings('app_state');
        if($stats != 'active'){
            return view('frezee.index');
        }
        return redirect()->route('home');
    }
}