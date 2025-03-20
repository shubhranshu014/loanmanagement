<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'loan_product_id',
        'borrower_id',
        'currency',
        'first_payment_date',
        'release_date',
        'applied_amount',
        'late_payment_penalties',
        'purpose_of_loan',
        'attachment',
        'description',
        'remarks',
        'status',
    ];

    protected $casts = [
        'release_date' => 'date', // Ensure it's a Carbon instance
        'first_payment_date' => 'date', // If needed, do the same for other date fields
    ];

    public function loanProduct()
    {
        return $this->belongsTo(LoanProduct::class, 'loan_product_id');
    }

    // Relationship with Member (Borrower)
    public function borrower()
    {
        return $this->belongsTo(Member::class, 'borrower_id');
    }
}
