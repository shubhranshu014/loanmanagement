@extends("admin.layout.adminlayout")

@section("admin")
     <div class="mt-4 container">
           <div class="d-flex align-items-center justify-content-between mb-3">
                 <h4>Loan Products</h4>
                 <div>
                       <a href="{{ route("admin.loan.calculatorview") }}" class="btn btn-primary">Calculation</a>
                       <a href="{{route('admin.add.loanproduct')}}" class="btn btn-primary">+ Add New</a>
                 </div>
           </div>

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
                              <table class="table table-hover table-striped">
                                    <thead class="table-light">
                                          <tr>
                                                <th>Name</th>
                                                <th>Interest Rate</th>
                                                <th>Interest Type</th>
                                                <th>Max Term</th>
                                                <th>Term Period</th>
                                                <th>Action</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @foreach ($loanproduct as $loan)

                                                         <tr>
                                                                 <td>{{$loan->name}}</td>
                                                                 <td>{{$loan->interest_rate}}{{"%"}}</td>
                                                                 <td>{{$loan->interest_type}}</td>
                                                                 <td>{{$loan->max_term}}</td>
                                                                 <td>{{$loan->term_period}}</td>
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