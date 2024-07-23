<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

function updateEnv($key, $value)
{
    $path = base_path('.env');

    if (File::exists($path)) {
        $env = File::get($path);

        $oldValue = env($key);

        // Jika kunci sudah ada, ganti nilainya
        if (strpos($env, "$key=") !== false) {
            $env = str_replace("$key=$oldValue", "$key=$value", $env);
        } else {
            // Jika kunci tidak ada, tambahkan kunci dan nilainya
            $env .= "\n$key=$value";
        }

        File::put($path, $env);

        Artisan::call('config:cache');
    }
}