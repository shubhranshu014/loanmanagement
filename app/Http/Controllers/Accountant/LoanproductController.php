<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\Loanproduct;
use Illuminate\Http\Request;

class LoanproductController extends Controller
{
    public function loanproduct()
    {
        $loanproduct = Loanproduct::all();
        return view("admin.loanproduct")->with(compact("loanproduct"));
    }

    public function addloanproduct()
    {
        return view("admin.addloanproduct");
    }
    public function storeloanproduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'loan_id' => 'required|string|max:255',
            'minimum_amount' => 'required|numeric|min:0',
            'maximum_amount' => 'required|numeric|min:0|gte:minimum_amount',
            'interest_rate' => 'required|numeric|min:0|max:100',
            'interest_type' => 'required|string',
            'max_term' => 'required|integer|min:1',
            'term_period' => 'required|string',
            'late_payment_penalties' => 'required|numeric|min:0|max:100',
            'status' => 'required|string',
            'loan_application_fee' => 'required|numeric|min:0',
            'loan_application_fee_type' => 'required|string',
            'loan_processing_fee' => 'required|numeric|min:0',
            'loan_processing_fee_type' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Loanproduct::create($validated);

        return redirect()->back()->with('success', 'Loan Product added successfully!');
    }
}
