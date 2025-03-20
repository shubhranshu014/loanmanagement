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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId("userid")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('memberid')->unique();
            $table->string('groupname');
            $table->foreignId('branchid')->constrained('branches')->onDelete('cascade');
            $table->string('email')->unique();
            $table->string("countrycode");
            $table->string('mobile');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->string('profession');
            $table->enum('maritalStatus', ['Single', 'Married']);
            $table->string('creditSource');
            $table->text('address');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
