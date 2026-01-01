<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Add competition types to events
        Schema::table('events', function (Blueprint $table) {
            $table->string('preliminary_type')->nullable()->after('preliminary_date'); // 'quiz' or 'project'
            $table->string('final_type')->nullable()->after('final_date'); // 'quiz' or 'project'
        });

        // 2. Add type to tasks
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('type')->default('submission')->after('description'); // 'submission', 'quiz'
            $table->integer('total_questions')->nullable()->after('end_time'); // Helper for admin
        });

        // 3. Create Quiz Questions table
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->text('question_text');
            $table->string('media_path')->nullable(); // For images/videos in question
            $table->integer('time_limit')->nullable(); // Seconds per question
            $table->timestamps();
        });

        // 4. Create Quiz Options table
        Schema::create('quiz_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_question_id')->constrained('quiz_questions')->onDelete('cascade');
            $table->string('option_text');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_options');
        Schema::dropIfExists('quiz_questions');

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['type', 'total_questions']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['preliminary_type', 'final_type']);
        });
    }
};
