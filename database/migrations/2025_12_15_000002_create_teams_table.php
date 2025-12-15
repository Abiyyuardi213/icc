<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke User (Pemilik Tim/Ketua)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Relasi ke Event/Lomba
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            
            $table->string('name'); // Nama Tim
            $table->string('status')->default('pending'); // pending, verified, rejected
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
