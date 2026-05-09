<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceAssignment extends Model
{
    protected $fillable = [
        'device_id',
        'user_id',
        'fecha_asignacion',
        'fecha_devolucion',
        'notas'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}