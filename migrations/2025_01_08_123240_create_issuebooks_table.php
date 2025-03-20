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
        Schema::create('issuebooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained("institutes")->cascadeOnDelete()->cascadeOnUpdate(); 
            $table->foreignId('student_id')->constrained("students")->cascadeOnDelete()->cascadeOnUpdate(); 
            $table->foreignId('book_id')->constrained("books")->cascadeOnDelete()->cascadeOnUpdate(); 
            $table->date('issue_date');
            $table->date('return_date')->nullable();
            $table->boolean('status')->default(1); // 1 for active, 0 for returned
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issuebooks');
    }
};
