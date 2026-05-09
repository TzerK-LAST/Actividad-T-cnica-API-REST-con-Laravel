<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['nombre', 'tipo', 'serial', 'estado'];

    public function assignments()
    {
        return $this->hasMany(DeviceAssignment::class);
    }
}
