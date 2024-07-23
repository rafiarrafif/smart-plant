<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowerHistory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'plant_id',
        'actived_by',
        'deactived_by',
        'is_active',
        'is_actived_by_system',
        'is_deactived_by_system',
        'soil_before',
        'soil_after',
        'temp_before',
        'temp_after',
        'air_before',
        'air_after',
        'shower_on',
        'shower_off',
        'shower_diff',
    ];

    public function plant() {
        return $this->belongsTo(Plant::class);
    }
    public function activatedBy() {
        return $this->belongsTo(User::class, 'actived_by');
    }
    public function deactivatedBy() {
        return $this->belongsTo(User::class, 'deactived_by');
    }
}