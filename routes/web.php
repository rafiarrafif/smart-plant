<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DevController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShowerController;
use App\Http\Controllers\ViewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


    /**
    * Created by Helmi Arrafif Kanahaya a.k.a Rafi Arrafif
    * For ABBS ICT FAIR 2024
    *
    * This is an open source project, anyone can reuse this code
    */

Route::get('ptest', function () {
    return view('welcome');
});

Route::get('api/add-data/{id}/{keystream}/{air}/{soil}/{temp}/{shower}', [APIController::class, 'updateData'])->name('addDataApi');
Route::get('pending', [ViewController::class, 'pending'])->name('pending');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('welcome', [AuthController::class, 'welcome'])->name('welcome');

Route::get('frezee', [ViewController::class, 'frezee'])->name('frezee.view')->withoutMiddleware('StateApp');

Route::name('google.')->group(function () {
    Route::get('auth/google/redirect', [AuthController::class, 'googleRedirect'])->name('redirect');
    Route::get('auth/google/callback', [AuthController::class, 'googleCallback'])->name('callback');
});
Route::name('discord.')->group(function () {
    Route::get('auth/discord/redirect', [AuthController::class, 'discordRedirect'])->name('redirect');
    Route::get('auth/discord/callback', [AuthController::class, 'discordCallback'])->name('callback');
});

Route::middleware('OnlyAdmin')->group(function () {
    Route::get('plant/create', [PlantController::class, 'create'])->name('plant.create');
    Route::get('plant/{plant:slug}/edit', [PlantController::class, 'edit'])->name('plant.edit');
    Route::post('plant', [PlantController::class, 'store'])->name('plant.store');
    Route::put('plant/{plant:slug}', [PlantController::class, 'update'])->name('plant.update');
    Route::delete('plant/{plant:slug}', [PlantController::class, 'destroy'])->name('plant.destroy');

    Route::get('settings/access', [SettingsController::class, 'access'])->name('settings.access');
    Route::post('settings/access', [SettingsController::class, 'accessAction'])->name('settings.access.action');

    Route::get('settings/app-suspend', [SettingsController::class, 'suspend'])->withoutMiddleware('StateApp')->name('settings.suspend');
    Route::post('settings/app-suspend', [SettingsController::class, 'suspendAction'])->withoutMiddleware('StateApp')->name('settings.suspend.action');
});

Route::middleware('AuthenticateAcc')->group(function () {
    Route::get('/', [ViewController::class, 'index'])->name('home');
    Route::post('api/get-data', [APIController::class, 'allIndex'])->name('getDataApi');
    Route::post('api/get-data/plant/{plant:slug}', [APIController::class, 'plantIndex'])->name('plant.api');
    Route::post('api/get-data/shower-history/{plant:slug}', [APIController::class, 'showerHistory'])->name('shower.history');
    Route::post('api/control/shower', [ShowerController::class, 'index'])->name('shower.trigger');
    Route::post('api/log-shower/{shower:id}', [ShowerController::class, 'APIViewHistory'])->name('api.shower.history.show');
    
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('settings/myaccount', [SettingsController::class, 'account'])->name('settings.account');
    Route::get('settings/about', [SettingsController::class, 'about'])->name('settings.about');
    Route::get('settings/follow', [SettingsController::class, 'follow'])->name('settings.follow');

    Route::get('plant/{plant:slug}/success', [ViewController::class, 'createPlantSuccess'])->name('plant.success');
    Route::resource('plant', PlantController::class)->except(['create', 'edit', 'store', 'update', 'destroy'])->missing(function (Request $request) {
        return redirect()->route('home')->with('error', 'Wrong Parameter');
    });
    
    Route::get('log', [ViewController::class, 'logIndex'])->name('log');
    Route::get('log/shower/{shower:id}', [ShowerController::class, 'history'])->name('shower.history.show');
    Route::get('log/activity/{log}', [ViewController::class, 'logShow'])->name('log.show');
});



// ROUTE DEV || MATIKAN ROUTE INI SAAT DI PRODUCTION
Route::get('direct-login', [DevController::class, 'directLogin']);