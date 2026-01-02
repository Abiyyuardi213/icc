<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->integer('correct_answers')->nullable()->after('score');
            $table->integer('wrong_answers')->nullable()->after('correct_answers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn(['correct_answers', 'wrong_answers']);
        });
    }
};
