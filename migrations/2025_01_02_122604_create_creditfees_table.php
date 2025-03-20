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
        Schema::create('creditfees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accountant_id')->constrained("users")->onDelete('cascade');
            $table->date('date');
            $table->string('receipt_no');
            $table->string('payment_mode');
            $table->foreignId('student_id')->constrained("students")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fee_type_id')->constrained("feetypes")->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('amount', 10, 2);
            $table->string('receiving_clerk');
            $table->string('admin_approved')->default(0);
            $table->foreignId('bank_id')->nullable()->constrained("banks")->onDelete('cascade');
            $table->string('upi_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creditfees');
    }
};
