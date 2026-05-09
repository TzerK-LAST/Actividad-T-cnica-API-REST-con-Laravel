<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignDeviceRequest;
use App\Services\DeviceService;
use Illuminate\Http\JsonResponse;

class DeviceController extends Controller
{
    public function __construct(private DeviceService $deviceService) {}

    public function index(): JsonResponse
    {
        try {
            $devices = $this->deviceService->getAll();
            return response()->json(['success' => true, 'data' => $devices]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function assign(AssignDeviceRequest $request): JsonResponse
    {
        try {
            $assignment = $this->deviceService->assign($request->validated());
            return response()->json(['success' => true, 'message' => 'Dispositivo asignado', 'data' => $assignment], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
