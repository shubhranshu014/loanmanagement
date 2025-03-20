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
        Schema::create('accountants', function (Blueprint $table) {
            $table->id();
            $table->foreignId("userid")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name'); // Accountant's name
            $table->string('email')->unique(); // Unique email
            $table->foreignId("instituteid")->constrained("institutes")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('phone'); // Phone number (can accommodate international numbers)
            $table->string("photo");
            $table->text('address'); // Full address
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accountants');
    }
};
