@extends("loanofficer.layouts.loanofficerlayout")
@section("loanofficer")
<div class="card bg-light">
     @if (session('success'))
           <div class="alert alert-success alert-dismissible fade show" role="alert">
                 {{ session('success') }}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
      @endif
     <div class="card-header bg-light text-white">
          <h4>Add New Loan</h4>
     </div>
     <div class="card-body">
          <form method="POST" action="{{route('loanofficer.loan.store')}}" enctype="multipart/form-data">
               @csrf
               <div class="row">
                    <!-- Loan ID -->
                    <div class="col-md-6 mb-3">
                         <label for="loan_id" class="form-label">Loan ID *</label>
                         <input type="text" class="form-control" id="loan_id" name="loan_id" placeholder="Loan ID"
                              readonly>
                    </div>

                    <!-- Loan Product -->
                    <div class="col-md-6 mb-3">
                         <label for="loan_product" class="form-label">Loan Product *</label>
                         <select class="form-select" id="loan_product_id" name="loan_product_id" required>
                              <option value="" selected>Select One</option>
                              <!-- Add options dynamically -->
                              @foreach ($loanproducts as $lp)
                                          <option value="{{$lp->id}}">{{$lp->name}}</option>
                                     @endforeach
                         </select>
                    </div>

                    <!-- Borrower -->
                    <div class="col-md-6 mb-3">
                         <label for="borrower" class="form-label">Borrower *</label>
                         <select class="form-select" id="borrower" name="borrower" required>
                              <option value="" selected>Select One</option>
                              <!-- Add options dynamically -->
                              @foreach ($members as $m)
                                          <option value="{{$m->id}}">{{$m->name}}{{" ("}}{{ $m->memberid}}{{")"}}</option>
                                     @endforeach
                         </select>
                    </div>

                    <!-- Currency -->
                    <div class="col-md-6 mb-3">
                         <label for="currency" class="form-label">Currency *</label>
                         <select class="form-select" id="currency" name="currency" required>
                              <option value="INR" selected>INR</option>
                              <option value="USD">USD</option>
                              <option value="EUR">EUR</option>
                         </select>
                    </div>

                    <!-- First Payment Date -->
                    <div class="col-md-6 mb-3">
                         <label for="first_payment_date" class="form-label">First Payment Date *</label>
                         <input type="date" class="form-control" id="first_payment_date" name="first_payment_date"
                              required>
                    </div>

                    <!-- Release Date -->
                    <div class="col-md-6 mb-3">
                         <label for="release_date" class="form-label">Release Date *</label>
                         <input type="date" class="form-control" id="release_date" name="release_date" required>
                    </div>

                    <!-- Applied Amount -->
                    <div class="col-md-6 mb-3">
                         <label for="applied_amount" class="form-label">Applied Amount *</label>
                         <input type="number" class="form-control" id="applied_amount" name="applied_amount" required>
                    </div>

                    <!-- Late Payment Penalties -->
                    <div class="col-md-6 mb-3">
                         <label for="late_payment_penalties" class="form-label">Late Payment Penalties *</label>
                         <div class="input-group">
                              <input type="number" class="form-control" id="late_payment_penalties"
                                   name="late_payment_penalties" required>
                              <span class="input-group-text">%</span>
                         </div>
                    </div>

                    <!-- Purpose of Loan -->
                    <div class="col-md-12 mb-3">
                         <label for="purpose_of_loan" class="form-label">Purpose of Loan *</label>
                         <input type="text" class="form-control" id="purpose_of_loan" name="purpose_of_loan" required>
                    </div>

                    <!-- Fee Deduct Account -->
                    <!-- <div class="col-md-6 mb-3">
                         <label for="fee_deduct_account" class="form-label">Fee Deduct Account *</label>
                         <select class="form-select" id="fee_deduct_account" name="fee_deduct_account" required>
                              <option value="" selected>Select One</option>
                         </select>
                    </div> -->

                    <!-- Attachment -->
                    <div class="col-md-12 mb-3">
                         <label for="attachment" class="form-label">Attachment</label>
                         <input type="file" class="form-control" id="attachment" name="attachment">
                    </div>

                    <!-- Description -->
                    <div class="col-md-12 mb-3">
                         <label for="description" class="form-label">Description</label>
                         <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <!-- Remarks -->
                    <div class="col-md-12 mb-3">
                         <label for="remarks" class="form-label">Remarks</label>
                         <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 text-center">
                         <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
               </div>
          </form>
     </div>
</div>


<script>
     $(document).ready(function () {
          $('#loan_product_id').on('change', function () {
               const loanProductId = $(this).val(); // Get selected loan product ID

               if (loanProductId) {
                    // AJAX request to fetch loan details
                    $.ajax({
                         url: `/api/get-loan-product/${loanProductId}`, // API endpoint
                         method: 'GET',
                         success: function (response) {
                              if (response.success) {
                                   // Populate fields with the response data
                                   $('#loan_id').val(response.data.loan_id);
                                   $('#late_payment_penalties').val(response.data.late_payment_penalties);
                              }
                         },
                         error: function () {
                              alert('Failed to fetch loan product details. Please try again.');
                         }
                    });
               } else {
                    // Clear fields if no loan product is selected
                    $('#loan_id').val('');
                    $('#late_payment_penalties').val('');
               }
          });
     });
</script>
@endsection