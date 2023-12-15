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
        Schema::create('schedule_tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('class')->nullable();
            $table->date('schedule_date');
            $table->time('schedule_time');
            $table->enum('type',['individual','all']);
            $table->string('student_code')->nullable();
            $table->foreign('student_code')->references('student_code')->on('students')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->enum('status',['schedule','in_progress','complete']);
            $table->boolean('is_sent')->default(false);
            $table->boolean('is_active')->default(true);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_tasks');
    }
};
