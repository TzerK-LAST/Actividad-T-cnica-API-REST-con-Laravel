<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'titulo'      => 'required|string|max:200',
            'descripcion' => 'required|string',
            'prioridad'   => 'in:baja,media,alta',
        ];
    }
}