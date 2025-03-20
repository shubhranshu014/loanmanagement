@extends("admin.layout.adminlayout")
@section("admin")
<div class="bg-light card">
     @if (session('success'))
           <div class="alert alert-success alert-dismissible fade show" role="alert">
                 {{ session('success') }}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
      @endif
     <div class="bg-light text-white card-header">
          <h4>Add Loan Product</h4>
     </div>
     <div class="card-body">
          <form method="POST" action="{{route('admin.store.loanproduct')}}">
               @csrf
               <div class="mb-3 row">
                    <!-- Name -->
                    <div class="col-md-6">
                         <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                         <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <!-- Starting Loan ID -->
                    <div class="col-md-6">
                         <label for="starting_loan_id" class="form-label">Loan ID <span
                                   class="text-danger">*</span></label>
                         <input type="text" class="form-control" id="loan_id" name="loan_id">
                    </div>
               </div>

               <div class="mb-3 row">
                    <!-- Minimum Amount -->
                    <div class="col-md-6">
                         <label for="minimum_amount" class="form-label">Minimum Amount $ <span
                                   class="text-danger">*</span></label>
                         <input type="number" class="form-control" id="minimum_amount" name="minimum_amount" required>
                    </div>
                    <!-- Maximum Amount -->
                    <div class="col-md-6">
                         <label for="maximum_amount" class="form-label">Maximum Amount $ <span
                                   class="text-danger">*</span></label>
                         <input type="number" class="form-control" id="maximum_amount" name="maximum_amount" required>
                    </div>
               </div>

               <div class="mb-3 row">
                    <!-- Interest Rate -->
                    <div class="col-md-6">
                         <label for="interest_rate" class="form-label">Interest Rate Per Year (%) <span
                                   class="text-danger">*</span></label>
                         <input type="number" step="0.01" class="form-control" id="interest_rate" name="interest_rate"
                              required>
                    </div>
                    <!-- Interest Type -->
                    <div class="col-md-6">
                         <label for="interest_type" class="form-label">Interest Type <span
                                   class="text-danger">*</span></label>
                         <select class="form-select" id="interest_type" name="interest_type" required>
                              <option value="Flat Rate">Flat Rate</option>
                              <option value="Mortgage amortization">Mortgage amortization</option>
                              <option value="Reducing Amount">Reducing Amount</option>
                              <option value="One-time payment">One-time payment</option>
                         </select>
                    </div>
               </div>
               <div class="mb-3 row">
                    <!-- Max Term -->
                    <div class="col-md-6">
                         <label for="max_term" class="form-label">Max Term <span class="text-danger">*</span></label>
                         <input type="number" class="form-control" id="max_term" name="max_term" required>
                    </div>
                    <!-- Term Period -->
                    <div class="col-md-6">
                         <label for="term_period" class="form-label">Term Period <span
                                   class="text-danger">*</span></label>
                         <select class="form-select" id="term_period" name="term_period" required>
                              <option value="Day">Day</option>
                              <option value="Week">Week</option>
                              <option value="Month">Month</option>
                              <option value="Year">Year</option>
                         </select>
                    </div>
               </div>

               <div class="mb-3 row">
                    <!-- Late Payment Penalties -->
                    <div class="col-md-6">
                         <label for="late_payment_penalties" class="form-label">Late Payment Penalties (%) <span
                                   class="text-danger">*</span></label>
                         <input type="number" step="0.01" class="form-control" id="late_payment_penalties"
                              name="late_payment_penalties" required>
                    </div>
                    <!-- Status -->
                    <div class="col-md-6">
                         <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                         <select class="form-select" id="status" name="status" required>
                              <option value="Active">Active</option>
                              <option value="Deactivate">Deactivate</option>
                         </select>
                    </div>
               </div>
               <div class="mb-3 row">
                    <!-- Loan Application Fee -->
                    <div class="col-md-6">
                         <label for="loan_application_fee" class="form-label">Loan Application Fee <span
                                   class="text-danger">*</span></label>
                         <input type="number" class="form-control" id="loan_application_fee" name="loan_application_fee"
                              required>
                    </div>
                    <!-- Loan Application Fee Type -->
                    <div class="col-md-6">
                         <label for="loan_application_fee_type" class="form-label">Loan Application Fee Type <span
                                   class="text-danger">*</span></label>
                         <select class="form-select" id="loan_application_fee_type" name="loan_application_fee_type"
                              required>
                              <option value="Fixed">Fixed</option>
                              <option value="Percentage">Percentage</option>
                         </select>
                    </div>
               </div>

               <div class="mb-3 row">
                    <!-- Loan Processing Fee -->
                    <div class="col-md-6">
                         <label for="loan_processing_fee" class="form-label">Loan Processing Fee <span
                                   class="text-danger">*</span></label>
                         <input type="number" class="form-control" id="loan_processing_fee" name="loan_processing_fee"
                              required>
                    </div>
                    <!-- Loan Processing Fee Type -->
                    <div class="col-md-6">
                         <label for="loan_processing_fee_type" class="form-label">Loan Processing Fee Type <span
                                   class="text-danger">*</span></label>
                         <select class="form-select" id="loan_processing_fee_type" name="loan_processing_fee_type"
                              required>
                              <option value="Fixed">Fixed</option>
                              <option value="Percentage">Percentage</option>
                         </select>
                    </div>
               </div>

               <!-- Description -->
               <div class="mb-3 row">
                    <div class="col-md-12">
                         <label for="description" class="form-label">Description</label>
                         <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
               </div>

               <!-- Submit Button -->
               <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                         <i class="bi bi-save"></i> ADD
                    </button>
               </div>
          </form>
     </div>
</div>
@endsection