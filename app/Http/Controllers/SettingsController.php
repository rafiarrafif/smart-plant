<?php

namespace App\Http\Controllers;

use App\Models\AppSettings;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class SettingsController extends Controller
{
    public function index() {
        $title = 'Pusat Pengaturan | Sutarno Technology';
        return view('settings.main', compact('title'));
    }

    public function account() {
        $title = 'Akun Saya | Sutarno Technology';
        $userID = auth()->user()->id;
        $userData = User::where('id', $userID)->first();

        return view('settings.account', compact('title','userData')); 
    }

    public function about() {
        $title = "Tentang Kami | Sutarno Technology";
        return view('settings.about', compact('title'));
    }

    public function follow() {
        $title = "Ikuti jejak kami | Sutarno Technology";
        return view('settings.follow', compact('title'));
    }

    public function access() {
        $title = "Pengaturan Akses Aplikasi | Sutarno Technology";
        return view('settings.access', compact('title'));
    }

    public function accessAction(Request $request) {
       $request->validate([
            'domain_spesial' => 'required',
            'role_special' => 'required|in:admin,moderator,viewer,pending',
            'role_default' => 'required|in:admin,moderator,viewer,pending',
       ]);

    //    $domain_spesial = AppSettings
    }

    public function suspend() {
        $title = "Bekukan Aplikasi | Sutarno Technology";
        return view('settings.suspend', compact('title'));
    }

    public function suspendAction(Request $request) {
        $state = $request->input('state');

        if ($state == 'frezee') {
            try {
                $appSettings = AppSettings::where('key', 'app_state')->first();
                $appSettings->value = 'frezee';
                $appSettings->save();
                return redirect()->route('home');
            } catch (\Exception $e) {
                return $e;
            }
        } elseif ($state == 'active'){
            try {
                $appSettings = AppSettings::where('key', 'app_state')->first();
                $appSettings->value = 'active';
                $appSettings->save();
                return redirect()->route('home');
            } catch (\Exception $e) {
                return $e;
            }
        }
    }
}