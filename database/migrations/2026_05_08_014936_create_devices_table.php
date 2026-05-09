<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('tipo', ['pc', 'laptop', 'movil', 'tablet', 'otro']);
            $table->string('serial')->unique();
            $table->enum('estado', ['disponible', 'asignado', 'en_reparacion'])->default('disponible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};