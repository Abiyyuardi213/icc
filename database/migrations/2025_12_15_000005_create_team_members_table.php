<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            
            $table->string('name');
            $table->string('npm');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('role')->default('member'); // 'leader' or 'member'
            
            // File Kartu Tanda Mahasiswa (KTM) jika diperlukan
            $table->string('ktm_path')->nullable(); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
