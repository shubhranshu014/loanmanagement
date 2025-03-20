@extends("admin.layout.adminlayout")
@section("admin")
<div class="row g-4">
     <div class="col-sm-12 col-xl-6">
          <div class="bg-light p-4 rounded h-100">
               <h6 class="mb-4">Add Branch</h6>
               @if(session('success'))
                       <div class="alert alert-success">
                              {{ session('success') }}
                       </div>
                  @endif
               <form action="{{route('admin.store.branch')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                         <label for="branchname" class="form-label">Branch Name</label>
                         <input type="text" class="form-control" id="branchname" name="branchname"
                              value="{{old('branchname')}}" placeholder="Enter Branch Name">
                         @error('branchname')
                               <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                         <label for="branchid" class="form-label">Branch Id</label>
                         <input type="text" class="form-control" id="branchid" name="branchid"
                              value="{{old('branchid')}}" placeholder="Enter Branch Id">
                         @error('branchid')
                               <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                         <label for="location" class="form-label">Location</label>
                         <textarea class="form-control" id="location" name="location"
                              placeholder="Enter Branch Address">{{ old('location') }}</textarea>
                         @error('location')
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
                              <th scope="col">Branch Name</th>
                              <th scope="col">Branch ID</th>
                              <th scope="col">Action</th>
                         </tr>
                    </thead>
                    <tbody>
                         @foreach ($branchs as $branch)
                                    <tr>
                                          <th scope="row">{{ $loop->iteration }}</th>
                                          <td>{{$branch->branchname}}</td>
                                          <td>{{$branch->branchid}}</td>
                                          <td>
                                                  <!-- Edit Button -->
                                                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$branch->id}}">
                                                       <i class="fas fa-edit"></i>
                                                  </button>
                                                  <!-- Delete Button -->
                                                  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$branch->id}}">
                                                       <i class="fas fa-trash-alt"></i>
                                                  </button>
                                                  <!-- View Button -->
                                                  <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{$branch->id}}">
                                                       <i class="fas fa-eye"></i>
                                                  </button>
                                          </td>
                                    </tr>


                                     <!-- Edit Modal -->
                         <div class="modal fade" id="editModal{{$branch->id}}" tabindex="-1">
                              <div class="modal-dialog">
                                   <div class="modal-content">
                                        <div class="modal-header">
                                             <h5 class="modal-title">Edit Branch</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                             <form action="{{ route('admin.update.branch',$branch->id) }}" method="POST">
                                                  @csrf
                                                  @method('PUT')
                                                  <div class="mb-3">
                                                       <label class="form-label">Branch Name</label>
                                                       <input type="text" class="form-control" name="branchname" value="{{$branch->branchname}}">
                                                  </div>
                                                  <div class="mb-3">
                                                       <label class="form-label">Branch Id</label>
                                                       <input type="text" class="form-control" name="branchid" value="{{$branch->branchid}}">
                                                  </div>
                                                  <div class="mb-3">
                                                       <label class="form-label">Location</label>
                                                       <textarea class="form-control" name="location">{{$branch->location}}</textarea>
                                                  </div>
                                                  <button type="submit" class="btn btn-primary">Update</button>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                         </div>
                          <!-- Delete Modal -->
                          <div class="modal fade" id="deleteModal{{$branch->id}}" tabindex="-1">
                              <div class="modal-dialog">
                                   <div class="modal-content">
                                        <div class="modal-header">
                                             <h5 class="modal-title">Delete Branch</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                             <p>Are you sure you want to delete this branch?</p>
                                             <form action="{{ route('admin.destroy.branch',$branch->id) }}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-danger">Delete</button>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                         </div>
                          <!-- View Modal -->
                          <div class="modal fade" id="viewModal{{$branch->id}}" tabindex="-1">
                              <div class="modal-dialog">
                                   <div class="modal-content">
                                        <div class="modal-header">
                                             <h5 class="modal-title">View Branch</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                             <p><strong>Branch Name:</strong> {{$branch->branchname}}</p>
                                             <p><strong>Branch Id:</strong> {{$branch->branchid}}</p>
                                             <p><strong>Location:</strong> {{$branch->location}}</p>
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