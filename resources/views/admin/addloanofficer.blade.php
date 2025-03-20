@extends("admin.layout.adminlayout")

@section("admin")
<div class="mb-4 row g-4">
     <div class="col-sm-12 col-xl-6">
          <div class="bg-light p-4 rounded h-100">
               <h6 class="mb-4">Add Loan Officer</h6>
               @if(session('success'))
                       <div class="alert alert-success">
                              {{ session('success') }}
                       </div>
                  @endif
               <form action="{{route('admin.store.loanofficer')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                         <label for="branchname" class="form-label">Branch Name</label>
                         <select class="form-select" id="branchname" name="branchname">
                              <option value="">Select Branch Name</option>
                              @foreach($branches as $branch)
                                          <option value="{{ $branch->id }}" {{ old('branchname') == $branch->branchname ? 'selected' : '' }}>
                                                {{ $branch->branchname }}
                                          </option>
                                     @endforeach
                         </select>
                         @error('branchname')
                                    <div class="text-danger">{{ $message }}</div>
                               @enderror
                    </div>
                    <div class="mb-3">
                         <label for="name" class="form-label">Name</label>
                         <input type="text" class="form-control" id="name" name="name"
                              value="{{old('name')}}" placeholder="Enter Name">
                         @error('name')
                               <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                         <label for="email" class="form-label">Email Id</label>
                         <input type="email" class="form-control" id="email" name="email"
                              value="{{old('email')}}" placeholder="Enter Email Id">
                         @error('email')
                               <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                         <label for="aadhar" class="form-label">Aadhar Number</label>
                         <input type="text" class="form-control" id="aadhar" name="aadhar"
                              value="{{old('aadhar')}}" placeholder="Enter Aadhar Number">
                         @error('aadhar')
                               <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                         <label for="pan" class="form-label">Pan Number</label>
                         <input type="text" class="form-control" id="pan" name="pan"
                              value="{{old('pan')}}" placeholder="Enter Pan Number">
                         @error('pan')
                               <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                         <label for="address" class="form-label">Address</label>
                         <textarea class="form-control" id="address" name="address"
                              placeholder="Enter Branch Address">{{ old('address') }}</textarea>
                         @error('address')
                               <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
               </form>
          </div>
     </div>
     <div class="col-sm-12 col-xl-6">
          <div class="bg-light p-4 rounded h-100">
               <h6 class="mb-4">Branch List Table</h6>
               <table class="table table-striped">
                    <thead>
                         <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email Id</th>
                              <th scope="col">Action</th>
                         </tr>
                    </thead> 
                    <tbody>
                    @foreach ($lofficer as $lf )   
                         <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{ $lf->name }}</td>
                              <td>{{ $lf->email }}</td>
                              <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $lf->id }}">
                                        <i class="fas fa-edit"></i>
                                   </button>
                                   <!-- Delete Button -->
                                   <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $lf->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                   </button>
                                   <!-- View Button -->
                                   <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $lf->id }}">
                                        <i class="fas fa-eye"></i>
                                   </button>
                              </td>
                         </tr>
                         <!-- Edit Modal -->
                         <div class="modal fade" id="editModal{{ $lf->id }}" tabindex="-1">
                              <div class="modal-dialog">
                                   <div class="modal-content">
                                        <div class="modal-header">
                                             <h5 class="modal-title">Edit Loan Officer</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.update.loanofficer', $lf->id) }}" method="POST">
                                             @csrf
                                             @method('PUT')
                                             <div class="modal-body">
                                                  <label>Name</label>
                                                  <input type="text" name="name" value="{{ $lf->name }}" class="form-control">
                                                  <label>Email</label>
                                                  <input type="email" name="email" value="{{ $lf->email }}" class="form-control">
                                                  <label>Branch Name</label>
                                                  <input type="text" name="barnch" value="{{ $lf->email }}" class="form-control">
                                                  <label>Email</label>
                                                  <input type="email" name="email" value="{{ $lf->email }}" class="form-control">
                                                  <label>Email</label>
                                                  <input type="email" name="email" value="{{ $lf->email }}" class="form-control">
                                                  <label>Email</label>
                                                  <input type="email" name="email" value="{{ $lf->email }}" class="form-control">
                                             </div>
                                             <div class="modal-footer">
                                                  <button type="submit" class="btn btn-primary">Update</button>
                                             </div>
                                        </form>
                                   </div>
                              </div>
                         </div>

                         <!-- Delete Modal -->
                         <div class="modal fade" id="deleteModal{{ $lf->id }}" tabindex="-1">
                              <div class="modal-dialog">
                                   <div class="modal-content">
                                        <div class="modal-header">
                                             <h5 class="modal-title">Confirm Delete</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">Are you sure you want to delete this Loan Officer?</div>
                                        <div class="modal-footer">
                                             <form action="{{ route('admin.delete.loanofficer', $lf->id) }}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-danger">Delete</button>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <!-- View Modal -->
                         <div class="modal fade" id="viewModal{{ $lf->id }}" tabindex="-1">
                              <div class="modal-dialog">
                                   <div class="modal-content">
                                        <div class="modal-header">
                                             <h5 class="modal-title">View Loan Officer Details</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                             <p><strong>Name:</strong> {{ $lf->name }}</p>
                                             <p><strong>Email:</strong> {{ $lf->email }}</p>
                                             <p><strong>Aadhar:</strong> {{ $lf->aadhar }}</p>
                                             <p><strong>PAN:</strong> {{ $lf->pan }}</p>
                                             <p><strong>Address:</strong> {{ $lf->address }}</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    @endforeach
                    </tbody>
               </table>
          </div>
     </div>
</div>
@endsection