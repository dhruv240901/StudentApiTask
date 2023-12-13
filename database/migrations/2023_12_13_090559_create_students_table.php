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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('student_code')->unique();
            $table->string('name',51);
            $table->string('email');
            $table->enum('gender',['male','female','other']);
            $table->string('parent_name',51);
            $table->enum('standard',[1,2,3,4,5,6,7,8,9,10,11,12]);
            $table->string('city',51);
            $table->string('state',51);
            $table->string('pincode',6);
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
        Schema::dropIfExists('students');
    }
};
