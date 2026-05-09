<?php

namespace App\Services;

use App\Models\Ticket;

class TicketService
{
    public function getAll(): object
    {
        return Ticket::with('user')->latest()->get();
    }

    public function getById(int $id): Ticket
    {
        return Ticket::with('user')->findOrFail($id);
    }

    public function create(array $data, int $userId): Ticket
    {
        return Ticket::create([
            'user_id'     => $userId,
            'titulo'      => $data['titulo'],
            'descripcion' => $data['descripcion'],
            'prioridad'   => $data['prioridad'] ?? 'media',
            'estado'      => 'abierto',
        ]);
    }

    public function update(int $id, array $data): Ticket
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($data);
        return $ticket;
    }

    public function delete(int $id): void
    {
        Ticket::findOrFail($id)->delete();
    }
}