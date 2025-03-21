<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function calculaterview()
    {
        return view("admin.loan_calculator");
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'loan_amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'interest_type' => 'required|string',
            'term' => 'required|integer|min:1',
            'term_period' => 'required|string|in:month,year',
            'late_payment_penalties' => 'required|numeric|min:0',
            'first_payment_date' => 'required|date',
            // 'loan_application_fee' => 'required|numeric|min:0',
            // 'loan_application_fee_type' => 'required|string|in:Fixed,Percentage',
            // 'loan_processing_fee' => 'required|numeric|min:0',
            // 'loan_processing_fee_type' => 'required|string|in:Fixed,Percentage',
        ]);

        // Extract input values
        $loanAmount = $request->loan_amount;
        $interestRate = $request->interest_rate / 100; // Convert percentage to decimal
        $term = $request->term;
        $termPeriod = $request->term_period;
        $latePaymentPenaltyRate = $request->late_payment_penalties / 100; // Convert percentage to decimal
        $firstPaymentDate = $request->first_payment_date;
        $interestType = $request->interest_type;

        // Convert term to months if term period is in years
        if ($termPeriod === 'year') {
            $term *= 12;
        }

        // Initialize variables
        $schedule = [];
        $balance = $loanAmount;
        $totalPayingAmount = 0; // To store the total paying amount

        // // Calculate loan application fee and processing fee
        // $loanApplicationFee = ($request->loan_application_fee_type === 'Percentage')
        //     ? $loanAmount * ($request->loan_application_fee / 100)
        //     : $request->loan_application_fee;

        // $loanProcessingFee = ($request->loan_processing_fee_type === 'Percentage')
        //     ? $loanAmount * ($request->loan_processing_fee / 100)
        //     : $request->loan_processing_fee;

        // // Add fees to the loan amount
        // $balance += $loanApplicationFee + $loanProcessingFee;

        // Calculate repayment schedule based on interest type
        switch ($interestType) {
            case 'Flat Rate':
                // Flat Rate: Interest is calculated on the original loan amount for the entire term
                $totalInterest = $loanAmount * $interestRate * ($term / 12);
                $totalPayment = $loanAmount + $totalInterest;
                $monthlyPayment = $totalPayment / $term;

                for ($i = 1; $i <= $term; $i++) {
                    $interest = $totalInterest / $term;
                    $principal = $monthlyPayment - $interest;
                    $balance -= $principal;
                    $latePaymentPenalty = $balance * $latePaymentPenaltyRate;
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
                // Fixed Rate: Equal monthly payments with interest calculated on the remaining balance
                $monthlyInterestRate = $interestRate / 12;
                $monthlyPayment = $loanAmount * $monthlyInterestRate / (1 - pow(1 + $monthlyInterestRate, -$term));

                for ($i = 1; $i <= $term; $i++) {
                    $interest = $balance * $monthlyInterestRate;
                    $principal = $monthlyPayment - $interest;
                    $balance -= $principal;
                    $latePaymentPenalty = $balance * $latePaymentPenaltyRate;
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
                // Reducing Amount: Principal is reduced equally each month, and interest is calculated on the remaining balance
                $monthlyPrincipal = $loanAmount / $term;
                $monthlyInterestRate = $interestRate / 12;

                for ($i = 1; $i <= $term; $i++) {
                    $interest = $balance * $monthlyInterestRate;
                    $principal = $monthlyPrincipal;
                    $monthlyPayment = $principal + $interest;
                    $balance -= $principal;
                    $latePaymentPenalty = $balance * $latePaymentPenaltyRate;
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

        return response()->json([
            'schedule' => $schedule,
            'total_paying_amount' => $totalPayingAmount, // Pass total paying amount to the response
        ]);
    }
}
