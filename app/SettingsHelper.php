<?php

use App\Models\AppSettings;

function AppSettings($key) {
    $getData = AppSettings::where('key', $key)->first();
    $value = $getData->value;
    return $value;
}