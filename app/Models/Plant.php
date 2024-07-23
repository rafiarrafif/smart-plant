<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'keystream',
        'notes',
        'temp',
        'soil',
        'air',
        'status',
        'is_settings_prefer',
        'settings_type_off',
        'settings_value_off',
        'settings_timer_max',
        'auto_shower_status',
        'auto_shower_time',
        'auto_shower_timer',
        'trigger_shower',
        'callback_shower',
        'created_by',
        'last_connection',
    ];

    public $incrementing = false;

    // Metode untuk mencari nilai kunci primer yang tersedia
    public static function getAvailablePrimaryKey()
    {
        $lastId = static::max('id');
        $availableId = null;

        for ($i = 1; $i <= $lastId; $i++) {
            $exists = static::where('id', $i)->exists();
            if (!$exists) {
                $availableId = $i;
                break;
            }
        }

        if (is_null($availableId)) {
            $availableId = $lastId + 1;
        }
        return $availableId;
    }

    // Override metode untuk menyimpan data baru
    public function save(array $options = [])
    {
        if(!$this->id){
            $this->id = static::getAvailablePrimaryKey();
        }
        return parent::save($options);
    }

    public function createdBy() {
        return $this->belongsTo(User::class);
    }
    public function showerHistory() {
        return $this->hasMany(ShowerHistory::class)->orderBy('created_at', 'desc');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}