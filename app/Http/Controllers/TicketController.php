<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(private TicketService $ticketService) {}

    public function index(): JsonResponse
    {
        try {
            $tickets = $this->ticketService->getAll();
            return response()->json(['success' => true, 'data' => $tickets]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $ticket = $this->ticketService->getById($id);
            return response()->json(['success' => true, 'data' => $ticket]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ticket no encontrado'], 404);
        }
    }

    public function store(CreateTicketRequest $request): JsonResponse
    {
        try {
            $ticket = $this->ticketService->create($request->validated(), $request->user()->id);
            return response()->json(['success' => true, 'message' => 'Ticket creado', 'data' => $ticket], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $ticket = $this->ticketService->update($id, $request->only(['titulo', 'descripcion', 'estado', 'prioridad']));
            return response()->json(['success' => true, 'message' => 'Ticket actualizado', 'data' => $ticket]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->ticketService->delete($id);
            return response()->json(['success' => true, 'message' => 'Ticket eliminado']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}