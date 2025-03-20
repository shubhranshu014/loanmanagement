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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accountant_id')->constrained("accountants")->onDelete('cascade');
            $table->string('voucher_name'); // Matches $v->name in the form
            $table->string('reference')->nullable();
            $table->string("paying_to");
            $table->string('pay_via')->nullable();
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->text('description')->nullable();
            $table->foreignId('bank_id')->nullable()->constrained("banks")->onDelete('cascade');
            $table->string('upi_id')->nullable();
            $table->string('admin_approved')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
