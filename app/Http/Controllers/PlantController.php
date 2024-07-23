<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambahkan Tanaman";
        return view('plants.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'max:100|required',
            'notes' => 'max:255'
        ]);
        $data = [
            'name' => $request->input('name'),
            'slug' => SlugService::createSlug(Plant::class, 'slug', $request->input('name')),
            'keystream' => generateRandomKeystream(12),
            'notes' => $request->input('notes') ?? null,
            'temp' => 0,
            'soil' => 0,
            'air' => 0,
            'status' => 'pending',
            'is_settings_prefer' => false,
            'settings_timer_max' => 10,
            'auto_shower_status' => false,
            'trigger_shower' => 0,
            'callback_shower' => 0,
            'created_by' => auth()->user()->id,
            'last_connection' => now()
        ];
        Plant::create($data);
        // return $data;

        return redirect()->route('home')->with('success', 'Tanaman '.$data['name'].' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant)
    {
        if($plant->status == 'pending') {
            if(auth()->user()->role != 'admin') {
                return redirect()->route('home')->with('error', 'Harap sambungkan dengan perangkat ESP terlebih dahulu');
            }else {
                return view('plants.pairing', compact('plant'));
            }
        }
        $title = "Atur " . $plant->name . " | Sutarno Tech";
        return view('plants.view', compact('title', 'plant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plant $plant)
    {
        $title = "Atur " . $plant->name . " | Suratno Tech";
        return view('plants.settings', compact('title', 'plant'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plant $plant)
    {
        // return $request;
        $storeData = [];
        $storeData['is_settings_prefer'] = false;
        $storeData['auto_shower_status'] = false;
        $request->validate([
            'plant_name' => 'required',
            'keystream' => 'required|size:12',
        ]);
        
        if ($request->input('settings_prefered') == 'on') {
            $request->validate([
                'settings_type' => 'required|in:soil,air,temp',
                'settings_value' => 'required',
                'settings_max_shower' => 'required|integer|min:0|max:4095',
            ]);
            $storeData['is_settings_prefer'] = true;
        }
        if ($request->input('auto_shower') == 'on') {
            $request->validate([
                'start_auto' =>'required|date_format:H:i',
                'stop_auto' =>'required|integer|min:5|max:120',
            ]);
            $storeData['auto_shower_status'] = true;
        }
        if ($request->input('plant_name') != $plant->name) {
            $storeData['slug'] = SlugService::createSlug(Plant::class, 'slug', $request->input('plant_name'));
        }
        
        $storeData['name'] = $request->input('plant_name');
        $storeData['keystream'] = $request->input('keystream');
        $storeData['notes'] = $request->input('description');
        $storeData['settings_type_off'] = $request->input('settings_type');
        $storeData['settings_value_off'] = $request->input('settings_value');
        $storeData['settings_timer_max'] = $request->input('settings_max_shower');
        $storeData['auto_shower_time'] = $request->input('start_auto');
        $storeData['auto_shower_timer'] = $request->input('stop_auto');

        try {
            $plant->update($storeData);
            $log = [
                'id' => $plant->id,
                'name' => $plant->name,
                'user' => auth()->user()->name,
            ];
            logEditPlant($log);
            
            return redirect()->route('plant.show', ['plant' => $plant->slug])->with('success', 'Tanaman '. $plant->name.' telah diperbarui');
        } catch(Exception $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
        $name = $plant->name;
        $plant->delete();
        return redirect()->route('home')->with('success', 'Tanaman ' . $name. ' telah dihapus');
    }
}