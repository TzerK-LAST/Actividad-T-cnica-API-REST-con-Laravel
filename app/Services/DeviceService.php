<?php

namespace App\Services;

use App\Models\Device;
use App\Models\DeviceAssignment;

class DeviceService
{
    public function getAll(): object
    {
        return Device::with('assignments')->get();
    }

    public function assign(array $data): DeviceAssignment
    {
        $device = Device::findOrFail($data['device_id']);
        $device->update(['estado' => 'asignado']);

        return DeviceAssignment::create($data);
    }
}