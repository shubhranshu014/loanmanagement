@extends("admin.layout.adminlayout")

@section("admin")
<div class="container mt-4">
     @if (session('success'))
           <div class="alert alert-success">
                 {{ session('success') }}
           </div>
      @endif
     <!-- Table Section -->
     <div class="card">
          <div class="card-body">
               <div class="table-responsive">
                    <div class="d-flex justify-content-end mb-2">
                         <div>
                              <input type="text" class="form-control form-control-sm w-auto" placeholder="Search">
                         </div>
                    </div>

                    <!-- Table -->
                    <table class="table table-striped table-hover">
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
                                                       @if ($l->status == 1)
                                                                         <span class="badge bg-success">Approved</span>
                                                                    @else
                                                                                             <form action="{{ route('admin.loan.changeStatus', $l->id) }}" method="POST"
                                                                                                     style="display: inline;">
                                                                                                     @csrf
                                                                                                     @method('PUT')
                                                                                                     <button type="submit" class="btn btn-warning btn-sm">Change to
                                                                                                            Approved</button>
                                                                                             </form>
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