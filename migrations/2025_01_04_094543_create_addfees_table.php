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
        Schema::create('addfees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained("students")->onDelete('cascade'); // FK to students table
            $table->foreignId('feetype_id')->constrained("feetypes")->onDelete('cascade'); // FK to feetypes table
            $table->decimal('amount', 8, 2); 
            $table->string('admin_approved')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addfees');
    }
};
