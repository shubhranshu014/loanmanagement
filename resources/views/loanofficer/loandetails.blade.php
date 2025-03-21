@extends('loanofficer.layouts.loanofficerlayout')
@section("loanofficer")
     <div class="mt-4 container">
           <div class="d-flex align-items-center justify-content-between mb-3">
                 <h4>Add New Loan</h4>
                 <div>
                       <a href="{{ route("loanofficer.loan.calculatorview") }}" class="btn btn-primary">Calculation</a>
                       <a href="{{route('loanofficer.loan.add')}}" class="btn btn-primary">+ Add New</a>
                 </div>
           </div>

           <!-- Table Section -->
           <div class="card">
                 <div class="card-body">
                       <div class="table-responsive">
                              <div class="d-flex justify-content-end mb-2">
                                    <div>
                                          <input type="text" class="w-auto form-control form-control-sm" placeholder="Search">
                                    </div>
                              </div>

                              <!-- Table -->
                              <table class="table table-hover table-striped">
                                    <thead class="table-light">
                                          <tr>
                                                <th>#</th>
                                                <th>Loan ID</th>
                                                <th>Loan Product</th>
                                                <th>Borrower</th>
                                                <th>Release Date</th>
                                                <th>Applied Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @foreach ($loans as $l)
                                                         <tr>
                                                                 <td>{{ $loop->iteration }}</td>
                                                                 <td>{{ $l->loan_id }}</td>
                                                                 <!-- Display loan product name -->
                                                                 <td>{{ $l->loanProduct->name }}</td>
                                                                 <!-- Display borrower name -->
                                                                 <td>{{ $l->borrower->name }} ({{ $l->borrower->memberid }})</td>
                                                                 <td>{{ $l->release_date->format('Y-m-d') }}</td>
                                                                 <td>{{ number_format($l->applied_amount, 2) }}</td>
                                                                 <td>
                                                                         <!-- Display status (active/inactive) -->
                                                                         @if ($l->status == 1)
                                                                                                <span class="bg-success badge">Approved</span>
                                                                                           @else
                                                                                                                    <span class="bg-warning badge">Pending</span>
                                                                                                               @endif
                                                                 </td>
                                                                 <td>
                                                                         <div class="dropdown">
                                                                                 <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                                        Action
                                                                                 </button>
                                                                                 <ul class="dropdown-menu">
                                                                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                                                 </ul>
                                                                         </div>
                                                                 </td>
                                                         </tr>
                                                    @endforeach
                                    </tbody>
                              </table>

                              <!-- Pagination -->
                       </div>
                 </div>
           </div>
     </div>
@endsection