@extends("loanofficer.layouts.loanofficerlayout")
@section("loanofficer")
        <div class="bg-light card">
                        <div class="bg-primary text-white card-header">
                                        <h4>Loan Calculator</h4>
                        </div>
                        <div class="card-body">
                                        <form id="loanCalculatorForm">
                                                        @csrf
                                                        <div class="mb-3 row">
                                                                        <div class="col-md-6">
                                                                                        <label for="loan_amount" class="form-label">Loan Amount (INR)</label>
                                                                                        <input type="number" class="form-control" id="loan_amount" name="loan_amount"
                                                                                                        required>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                                        <label for="interest_rate" class="form-label">Interest Rate Per Year (%)</label>
                                                                                        <input type="number" step="0.01" class="form-control" id="interest_rate"
                                                                                                        name="interest_rate" required>
                                                                        </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                                        <div class="col-md-6">
                                                                                        <label for="interest_type" class="form-label">Interest Type</label>
                                                                                        <select class="form-select" id="interest_type" name="interest_type" required>
                                                                                                        <option value="">Select One</option>
                                                                                                        <option value="Flat Rate">Flat Rate</option>
                                                                                                        <option value="Fixed Rate">Fixed Rate</option>
                                                                                                        <option value="Reducing Amount">Reducing Amount</option>
                                                                                        </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                                        <label for="term" class="form-label">Term (Months)</label>
                                                                                        <input type="number" class="form-control" id="term" name="term" required>
                                                                        </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                                        <div class="col-md-4">
                                                                                        <label for="term_period" class="form-label">Term Period</label>
                                                                                        <select class="form-select" id="term_period" name="term_period" required>
                                                                                                        <option value="">Select One</option>
                                                                                                        <option value="month">Month</option>
                                                                                                        <option value="year">Year</option>
                                                                                        </select>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                                        <label for="late_payment_penalties" class="form-label">Late Payment Penalties
                                                                                                        (%)</label>
                                                                                        <input type="number" class="form-control" id="late_payment_penalties"
                                                                                                        name="late_payment_penalties" required>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                                        <label for="first_payment_date" class="form-label">First Payment Date</label>
                                                                                        <input type="date" class="form-control" id="first_payment_date"
                                                                                                        name="first_payment_date" required>
                                                                        </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                                        <div class="col-md-6">
                                                                                        <label for="loan_application_fee" class="form-label">Loan Application
                                                                                                        Fee</label>
                                                                                        <input type="number" class="form-control" id="loan_application_fee"
                                                                                                        name="loan_application_fee" required>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                                        <label for="loan_application_fee_type" class="form-label">Loan Application Fee
                                                                                                        Type</label>
                                                                                        <select class="form-select" id="loan_application_fee_type"
                                                                                                        name="loan_application_fee_type" required>
                                                                                                        <option value="Fixed">Fixed</option>
                                                                                                        <option value="Percentage">Percentage</option>
                                                                                        </select>
                                                                        </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                                        <div class="col-md-6">
                                                                                        <label for="loan_processing_fee" class="form-label">Loan Processing Fee</label>
                                                                                        <input type="number" class="form-control" id="loan_processing_fee"
                                                                                                        name="loan_processing_fee" required>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                                        <label for="loan_processing_fee_type" class="form-label">Loan Processing Fee
                                                                                                        Type</label>
                                                                                        <select class="form-select" id="loan_processing_fee_type"
                                                                                                        name="loan_processing_fee_type" required>
                                                                                                        <option value="Fixed">Fixed</option>
                                                                                                        <option value="Percentage">Percentage</option>
                                                                                        </select>
                                                                        </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Calculate</button>
                                        </form>

                                        <div class="mt-4" id="loanResult" style="display: none;">
                                                        <h3 id="totalPayingAmount"></h3>
                                                        <h5>Fees Summary</h5>
                                                        <table class="table table-bordered">
                                                                        <thead>
                                                                                        <tr>
                                                                                                        <th>Loan Application Fee</th>
                                                                                                        <th>Loan Processing Fee</th>
                                                                                                        <th>Total Fees</th>
                                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                                        <tr>
                                                                                                        <td id="loanApplicationFee"></td>
                                                                                                        <td id="loanProcessingFee"></td>
                                                                                                        <td id="totalFees"></td>
                                                                                        </tr>
                                                                        </tbody>
                                                        </table>
                                                        <h5>Loan Repayment Schedule</h5>
                                                        <table class="table table-bordered">
                                                                        <thead>
                                                                                        <tr>
                                                                                                        <th>Payment Date</th>
                                                                                                        <th>Principal Amount</th>
                                                                                                        <th>Interest</th>
                                                                                                        <th>Late Payment Penalty</th>
                                                                                                        <th>Amount to Pay</th>
                                                                                                        <th>Balance</th>
                                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="loanScheduleBody"></tbody>
                                                        </table>
                                        </div>
                        </div>
        </div>

        <!-- jQuery Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
                        $(document).ready(function () {
                                        $('#loanCalculatorForm').on('submit', function (event) {
                                                        event.preventDefault();

                                                        $.ajax({
                                                                        url: "{{ route('loanofficer.calculate.loan') }}",
                                                                        type: "POST",
                                                                        data: $(this).serialize(),
                                                                        dataType: "json",
                                                                        success: function (response) {
                                                                                        if (response.schedule && response.total_paying_amount !== undefined) {
                                                                                                        $('#loanApplicationFee').text(`INR ${parseFloat(response.loan_application_fee).toFixed(2)}`);
                                                                                                        $('#loanProcessingFee').text(`INR ${parseFloat(response.loan_processing_fee).toFixed(2)}`);
                                                                                                        $('#totalFees').text(`INR ${(parseFloat(response.loan_application_fee) + parseFloat(response.loan_processing_fee)).toFixed(2)}`);

                                                                                                        let scheduleHtml = "";
                                                                                                        response.schedule.forEach(function (row) {
                                                                                                                        scheduleHtml += `
                                                                <tr>
                                                                        <td>${row.payment_date}</td>
                                                                        <td>${parseFloat(row.principal_amount).toFixed(2)}</td>
                                                                        <td>${parseFloat(row.interest).toFixed(2)}</td>
                                                                        <td>${parseFloat(row.late_payment_penalty).toFixed(2)}</td>
                                                                        <td>${parseFloat(row.amount_to_pay).toFixed(2)}</td>
                                                                        <td>${parseFloat(row.balance).toFixed(2)}</td>
                                                                </tr>`;
                                                                                                        });

                                                                                                        $('#loanScheduleBody').html(scheduleHtml);
                                                                                                        $('#totalPayingAmount').html(`Total Paying Amount: INR- ${response.total_paying_amount.toFixed(2)}`);
                                                                                                        $('#loanResult').fadeIn();
                                                                                        } else {
                                                                                                        alert("Invalid response from the server.");
                                                                                        }
                                                                        },
                                                                        error: function () {
                                                                                        alert("Error! Please check your inputs and try again.");
                                                                        }
                                                        });
                                        });
                        });
        </script>
@endsection