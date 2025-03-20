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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("instituteid")->constrained("institutes")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("categoryid")->constrained("categories")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name')->unique();;
            $table->string('code')->nullable();
            $table->string('syllabus')->nullable();
            $table->text('description');
            $table->string('duration'); // e.g., 6 months or Year
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
