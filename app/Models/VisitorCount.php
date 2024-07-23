<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_id',
        'device_model',
        'device_platform',
        'browser_version',
        'last_visit',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}