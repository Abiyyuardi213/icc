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
        Schema::table('teams', function (Blueprint $table) {
            $table->boolean('is_finalist')->default(false)->after('status');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->string('stage')->default('preliminary')->after('type'); // preliminary, final
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('is_finalist');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('stage');
        });
    }
};
