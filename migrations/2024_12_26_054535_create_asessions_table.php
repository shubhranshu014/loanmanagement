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
        Schema::create('asessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained("institutes")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('course_id')->constrained("courses")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asessions');
    }
};
