<?php

namespace App\Http\Controllers\Loanofficer;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Loanproduct;
use App\Models\Member;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function loanadd()
    {
        $loanproducts = Loanproduct::all();
        $members = Member::all();
        return view("loanofficer.addloan")->with(compact("loanproducts", "members"));
    }

    public function getLoanProduct($id)
    {
        $loanProduct = LoanProduct::find($id);

        if ($loanProduct) {
            return response()->json([
                'success' => true,
                'data' => [
                    'loan_id' => $loanProduct->loan_id,
                    'late_payment_penalties' => $loanProduct->late_payment_penalties,
                ],
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Loan product not found.',
            ], 404);
        }
    }

    public function loanstore(Request $request)
    {
        $validated = $request->validate([
            'loan_id' => 'required|string|max:255',
            'loan_product_id' => 'required',
            'borrower' => 'required|exists:members,id',
            'currency' => 'required|string|in:INR,USD,EUR',
            'first_payment_date' => 'required|date',
            'release_date' => 'required|date',
            'applied_amount' => 'required|numeric|min:0',
            'late_payment_penalties' => 'required|numeric|min:0|max:100',
            'purpose_of_loan' => 'required|string|max:255',
            'attachment' => 'nullable|file|mimes:jpeg,png,pdf,docx',
            'description' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        $loans = new Loan();
        $loans->loan_id = $validated["loan_id"];
        $loans->loan_product_id = $validated["loan_product_id"];
        $loans->borrower_id = $validated["borrower"];
        $loans->currency = $validated["currency"];
        $loans->first_payment_date = $validated["first_payment_date"];
        $loans->release_date = $validated["release_date"];
        $loans->applied_amount = $validated["applied_amount"];
        $loans->late_payment_penalties = $validated["late_payment_penalties"];
        $loans->purpose_of_loan = $validated["purpose_of_loan"];
        $loans->description = $validated["description"];
        $loans->remarks = $validated["remarks"];

        if ($request->hasFile('attachment')) {
            $attachments = time() . rand(1, 99) . 'att.' . $request->file('attachment')->extension();
            $request->file('attachment')->storeAs('uploads', $attachments);
            $loans->attachment = $attachments;
        } else {
            $loans->attachment = null; // Or handle it as per your logic
        }

        $loans->save();

        return redirect()->back()->with('success', 'Loan data stored successfully.');
    }
}
