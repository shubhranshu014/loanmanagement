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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_id');
            $table->foreignId('loan_product_id')->constrained("loanproducts")->onDelete('cascade');
            $table->foreignId('borrower_id')->constrained('members')->onDelete('cascade');
            $table->string('currency');
            $table->date('first_payment_date');
            $table->date('release_date');
            $table->decimal('applied_amount', 15, 2);
            $table->decimal('late_payment_penalties', 5, 2);
            $table->string('purpose_of_loan');
            $table->string('attachment')->nullable();
            $table->text('description')->nullable();
            $table->text('remarks')->nullable();
            $table->string("status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
