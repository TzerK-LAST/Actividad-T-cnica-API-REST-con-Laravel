<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function assignments()
    {
        return $this->hasMany(DeviceAssignment::class);
    }

    public function logs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
