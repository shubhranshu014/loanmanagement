@extends("admin.layout.adminlayout")
@section("admin")

        <div class="bg-light card">
                        <div class="bg-light text-white card-header">
                                        <h4>Loan Calculator</h4>
                        </div>
                        <div class="card-body">
                                        <form id="loanCalculatorForm">
                                                        @csrf
                                                        <div class="mb-3 row">
                                                                        <div class="col-md-6">
                                                                                        <label for="loan_amount" class="form-label">Loan Amount ($)</label>
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
                                                                                                        <option value="Mortgage amortization">Mortgage amortization</option>
                                                                                                        <option value="Reducing Amount">Reducing Amount</option>
                                                                                                        <option value="One-time payment">One-time payment</option>
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
                                                                                                        <option value="">Select One</option>
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
                                                                                                        <option value="">Select One</option>
                                                                                                        <option value="Fixed">Fixed</option>
                                                                                                        <option value="Percentage">Percentage</option>
                                                                                        </select>
                                                                        </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Calculate</button>
                                        </form>

                                        <div class="mt-4" id="loanResult" style="display: none;">
                                                        <h3 id="totalPayingAmount"></h3>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
                        $(document).ready(function () {
                                        $('#loanCalculatorForm').on('submit', function (event) {
                                                        event.preventDefault();

                                                        $.ajax({
                                                                        url: "{{ route('admin.calculate.loan') }}",
                                                                        type: "POST",
                                                                        data: $(this).serialize(),
                                                                        dataType: "json",
                                                                        success: function (response) {
                                                                                        let scheduleHtml = "";
                                                                                        response.schedule.forEach(function (row) {
                                                                                                        scheduleHtml += `
                                                                <tr>
                                                                        <td>${row.payment_date}</td>
                                                                        <td>${row.principal_amount.toFixed(2)}</td>
                                                                        <td>${row.interest.toFixed(2)}</td>
                                                                        <td>${row.late_payment_penalty.toFixed(2)}</td>
                                                                        <td>${row.amount_to_pay.toFixed(2)}</td>
                                                                        <td>${row.balance.toFixed(2)}</td>
                                                                </tr>`;
                                                                                        });

                                                                                        $('#loanScheduleBody').html(scheduleHtml);
                                                                                        $('#totalPayingAmount').html(`Total Paying Amount: $${response.total_paying_amount.toFixed(2)}`); // Display total paying amount
                                                                                        $('#loanResult').fadeIn();
                                                                        },
                                                                        error: function () {
                                                                                        alert("Something went wrong! Please check your inputs.");
                                                                        }
                                                        });
                                        });
                        });
        </script>
@endsection