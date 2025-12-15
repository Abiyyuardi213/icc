<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Lomba (e.g. "Web Design")
            $table->string('slug')->unique(); // URL friendly name
            $table->text('description')->nullable();
            
            // Waktu Pendaftaran
            $table->dateTime('registration_start');
            $table->dateTime('registration_end');
            
            // Waktu Lomba
            $table->dateTime('event_start');
            $table->dateTime('event_end');
            
            // Aturan
            $table->integer('max_members')->default(3); // Jumlah anggota maksimal
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
