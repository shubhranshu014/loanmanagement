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


    public function calculaterview()
    {
        return view("loanofficer.loan_calculator");
    }


    public function calculate(Request $request)
    {
        $request->validate([
            'loan_amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|between:0,100',
            'interest_type' => 'required|string|in:Flat Rate,Fixed Rate,Reducing Amount',
            'term' => 'required|integer|min:1',
            'term_period' => 'required|string|in:month,year',
            'late_payment_penalties' => 'required|numeric|min:0',
            'first_payment_date' => 'required|date',
            'loan_application_fee' => 'required|numeric|min:0',
            'loan_application_fee_type' => 'required|string|in:Fixed,Percentage',
            'loan_processing_fee' => 'required|numeric|min:0',
            'loan_processing_fee_type' => 'required|string|in:Fixed,Percentage',
        ]);

        $loanAmount = $request->loan_amount;
        $interestRate = $request->interest_rate / 100;
        $term = $request->term;
        $termPeriod = $request->term_period;
        $latePaymentPenaltyRate = $request->late_payment_penalties / 100;
        $firstPaymentDate = $request->first_payment_date;
        $interestType = $request->interest_type;

        // Convert term to months if period is years
        if ($termPeriod === 'year') {
            $term *= 12;
        }

        // Calculate Fees
        $loanApplicationFee = ($request->loan_application_fee_type === 'Percentage')
            ? $loanAmount * ($request->loan_application_fee / 100)
            : $request->loan_application_fee;

        $loanProcessingFee = ($request->loan_processing_fee_type === 'Percentage')
            ? $loanAmount * ($request->loan_processing_fee / 100)
            : $request->loan_processing_fee;

        // Initialize Variables
        $schedule = [];
        $balance = $loanAmount;
        $totalPayingAmount = 0;

        // Interest Calculations
        switch ($interestType) {
            case 'Flat Rate':
                $totalInterest = $loanAmount * $interestRate * ($term / 12);
                $totalPayment = $loanAmount + $totalInterest;
                $monthlyPayment = $totalPayment / $term;

                for ($i = 1; $i <= $term; $i++) {
                    $interest = $totalInterest / $term;
                    $principal = $monthlyPayment - $interest;
                    $balance -= $principal;
                    $latePaymentPenalty = $balance > 0 ? $balance * $latePaymentPenaltyRate : 0;
                    $amountToPay = $monthlyPayment + $latePaymentPenalty;

                    $schedule[] = [
                        'payment_date' => date('Y-m-d', strtotime("$firstPaymentDate +" . ($i - 1) . " months")),
                        'principal_amount' => $principal,
                        'interest' => $interest,
                        'late_payment_penalty' => $latePaymentPenalty,
                        'amount_to_pay' => $amountToPay,
                        'balance' => max($balance, 0),
                    ];

                    $totalPayingAmount += $amountToPay;
                }
                break;

            case 'Fixed Rate':
                $monthlyInterestRate = $interestRate / 12;
                $monthlyPayment = $loanAmount * $monthlyInterestRate / (1 - pow(1 + $monthlyInterestRate, -$term));

                for ($i = 1; $i <= $term; $i++) {
                    $interest = $balance * $monthlyInterestRate;
                    $principal = $monthlyPayment - $interest;
                    $balance -= $principal;
                    $latePaymentPenalty = $balance > 0 ? $balance * $latePaymentPenaltyRate : 0;
                    $amountToPay = $monthlyPayment + $latePaymentPenalty;

                    $schedule[] = [
                        'payment_date' => date('Y-m-d', strtotime("$firstPaymentDate +" . ($i - 1) . " months")),
                        'principal_amount' => $principal,
                        'interest' => $interest,
                        'late_payment_penalty' => $latePaymentPenalty,
                        'amount_to_pay' => $amountToPay,
                        'balance' => max($balance, 0),
                    ];

                    $totalPayingAmount += $amountToPay;
                }
                break;

            case 'Reducing Amount':
                $monthlyPrincipal = $loanAmount / $term;
                $monthlyInterestRate = $interestRate / 12;

                for ($i = 1; $i <= $term; $i++) {
                    $interest = $balance * $monthlyInterestRate;
                    $principal = $monthlyPrincipal;
                    $monthlyPayment = $principal + $interest;
                    $balance -= $principal;
                    $latePaymentPenalty = $balance > 0 ? $balance * $latePaymentPenaltyRate : 0;
                    $amountToPay = $monthlyPayment + $latePaymentPenalty;

                    $schedule[] = [
                        'payment_date' => date('Y-m-d', strtotime("$firstPaymentDate +" . ($i - 1) . " months")),
                        'principal_amount' => $principal,
                        'interest' => $interest,
                        'late_payment_penalty' => $latePaymentPenalty,
                        'amount_to_pay' => $amountToPay,
                        'balance' => max($balance, 0),
                    ];

                    $totalPayingAmount += $amountToPay;
                }
                break;

            default:
                return response()->json(['error' => 'Invalid interest type'], 400);
        }

        // Return the calculated results
        return response()->json([
            'schedule' => $schedule,
            'total_paying_amount' => $totalPayingAmount,
            'loan_application_fee' => $loanApplicationFee,
            'loan_processing_fee' => $loanProcessingFee
        ]);
    }

}
