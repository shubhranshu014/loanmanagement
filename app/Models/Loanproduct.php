<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loanproduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'loan_id',
        'minimum_amount',
        'maximum_amount',
        'interest_rate',
        'interest_type',
        'max_term',
        'term_period',
        'late_payment_penalties',
        'status',
        'loan_application_fee',
        'loan_application_fee_type',
        'loan_processing_fee',
        'loan_processing_fee_type',
        'description',
    ];
}
