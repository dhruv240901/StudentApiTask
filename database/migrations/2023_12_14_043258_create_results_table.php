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
        Schema::create('results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id');
            $table->foreign('student_id')->references('id')->on('students')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->integer('science');
            $table->integer('maths');
            $table->integer('english');
            $table->integer('gujarati');
            $table->integer('hindi');
            $table->integer('total_marks');
            $table->decimal('percentage', 5, 2);
            $table->decimal('percentile', 5, 2);
            $table->enum('result',['First Class With Destinction','First Class','Second Class','Pass Class','Fail']);
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
        Schema::dropIfExists('results');
    }
};
