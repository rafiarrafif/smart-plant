<?php

use App\Models\Logging;

function logRegisterUser($user) {
    $data = [
        'title' => 'Registrasi Anggota Baru',
        'description' => $user['name'].' dengan alamat email '. $user['email']. ' mencoba bergabung ke dalam ekosistem Sutarno tech. Anda dapat mengizinkannya untuk bergabung atau menolaknya di pusat anggota pada setelan'
    ];

    try {
        Logging::create($data);
        return response('success');
    } catch (\Exception $e){
        return response($e);
    }
}

function logLoginUser($user) {
    $data = [
        'title' => $user['name'].' Telah Login',
        'description' => 'Seseorang telah login menggunakan email '. $user['email']. ' pada pukul '. $user['time']. ' dengan IP '. $user['ip']. '. Segera ambil tidakan jika ada aktifitas mencurigakan'
    ];

    try {
        Logging::create($data);
        return response('success');
    } catch (\Exception $e){
        return response($e);
    }
}

function logEditPlant($plant) {
    $data = [
        'title' => 'Pengaturan Tanaman '.$plant['name'].' Telah Diubah',
        'description' => 'Admin dengan nama '.$plant['user'].' telah mengubah pengaturan Tanaman '. $plant['id']. ' yang bernama Tanaman '.$plant['name']
    ];

    try {
        Logging::create($data);
        return response('success');
    } catch (\Exception $e){
        return response($e);
    }
}