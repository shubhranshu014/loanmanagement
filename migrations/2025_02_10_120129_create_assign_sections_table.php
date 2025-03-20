<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assign_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courseid')->constrained('courses')->onDelete('cascade');
            $table->foreignId('studentid')->constrained('students')->onDelete('cascade');
            $table->foreignId('sectionid')->constrained('sections')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['studentid', 'courseid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_sections');
    }
};
