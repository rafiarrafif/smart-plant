<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevController extends Controller
{
    public function directLogin() {
        Auth::loginUsingId(1);
        return redirect()->route('home');
    }
}