<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        $devices = [
            [
                'nombre' => 'Laptop HP',
                'tipo'   => 'laptop',
                'serial' => 'HP-001',
                'estado' => 'disponible'
            ],
            [
                'nombre' => 'PC Dell',
                'tipo'   => 'pc',
                'serial' => 'DL-001',
                'estado' => 'disponible'
            ],
            [
                'nombre' => 'iPad Pro',
                'tipo'   => 'tablet',
                'serial' => 'IP-001',
                'estado' => 'disponible'
            ],
        ];

        foreach ($devices as $device) {
            Device::create($device);
        }
    }
}