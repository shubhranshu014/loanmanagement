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
        Schema::create('loanproducts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('loan_id');
            $table->decimal('minimum_amount', 10, 2);
            $table->decimal('maximum_amount', 10, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->string('interest_type');
            $table->integer('max_term');
            $table->string('term_period');
            $table->decimal('late_payment_penalties', 5, 2);
            $table->string('status');
            $table->decimal('loan_application_fee', 10, 2);
            $table->string('loan_application_fee_type');
            $table->decimal('loan_processing_fee', 10, 2);
            $table->string('loan_processing_fee_type');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loanproducts');
    }
};
