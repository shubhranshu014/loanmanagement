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
            $table->id();
            $table->string('photo');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->foreignId('user_id')->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('institute_id')->constrained("institutes")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('course_id')->constrained("courses")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('session_id')->constrained("asessions")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('status');
            $table->string('admission_date');
            $table->string('roll_no')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('gender');
            $table->string('dob')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('aadhaar')->nullable();
            $table->string('country');
            $table->string('state');
            $table->text('address')->nullable();
            $table->string('nationality');
            $table->string('mother_tongue');
            $table->string("hostel");
            $table->string("transportation");
            $table->string("reference")->nullable();
            $table->string('father_name');
            $table->string('father_occupation')->nullable();
            $table->string('father_email')->nullable();
            $table->string('father_phone');
            $table->text('father_address')->nullable();
            $table->string('mother_name');
            $table->string('mother_occupation')->nullable();
            $table->string('mother_email')->nullable();
            $table->string('mother_phone');
            $table->text('mother_address')->nullable();
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
