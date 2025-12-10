<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            $table->enum('competition_type', ['Basis Data', 'Pemrograman Terstruktur']); // Jenis Kompetisi
            $table->string('team_name')->unique(); // Nama Tim

            $table->string('leader_name');
            $table->string('leader_npm')->unique();
            $table->string('leader_email')->unique();
            $table->string('leader_phone');

            $table->string('member_1_name');
            $table->string('member_1_npm')->unique();

            $table->string('member_2_name')->nullable();
            $table->string('member_2_npm')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
