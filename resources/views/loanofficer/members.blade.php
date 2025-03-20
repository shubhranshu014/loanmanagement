@extends("loanofficer.layouts.loanofficerlayout")
@section("loanofficer")
<div class="row g-4">
     <!-- Left Side: Add New Member -->
     <div class="col-sm-12 col-xl-6">
          <div class="bg-light rounded h-100 p-4">
               <h4 class="mb-4">Add New Member</h4>
               @if(session('success'))
                       <div class="alert alert-success">
                              {{ session('success') }}
                       </div>
                  @endif
               <form action="{{route('loanofficer.store.members')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                         <!-- <div class="col-md-6"> -->
                         <label for="firstName" class="form-label">Name <span class="text-danger">*</span></label>
                         <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name">
                    </div>
                    <div class="row mb-3">
                         <div class="col-md-6">
                              <label for="memberNo" class="form-label">Member ID <span
                                        class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="memberid" name="memberid" value="">
                         </div>
                         <div class="col-md-6">
                              <label for="groupname" class="form-label">Group Name <span
                                        class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="groupname" name="groupname"
                                   placeholder="Group Name">
                         </div>
                    </div>
                    <div class="row mb-3">
                         <div class="col-md-6">
                              <label for="branch" class="form-label">Branch <span class="text-danger">*</span></label>
                              <select class="form-select" id="branchid" name="branchid">
                                   <option selected>Select Branch</option>
                                   @foreach ($branchs as $b)
                                                <option value="{{$b->id}}">{{$b->branchname}}</option>
                                           @endforeach
                              </select>
                         </div>
                         <div class="col-md-6">
                              <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                         </div>
                    </div>
                    <div class="row mb-3">
                         <div class="col-md-6">
                              <label for="countryCode" class="form-label">Country Code <span
                                        class="text-danger">*</span></label>
                              <select class="form-select" id="countryCode" name="countryCode">
                                   <option selected>Country Code</option>
                                   <option value="+1">+1</option>
                                   <option value="+44">+44</option>
                                   <option value="+91">+91</option>
                              </select>
                         </div>
                         <div class="col-md-6">
                              <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
                         </div>
                    </div>
                    <div class="row mb-3">
                         <div class="col-md-6">
                              <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                              <select class="form-select" id="gender" name="gender">
                                   <option selected>Select One</option>
                                   <option value="Male">Male</option>
                                   <option value="Female">Female</option>
                              </select>
                         </div>
                         <div class="col-md-6">
                              <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="city" name="city" placeholder="City">
                         </div>
                    </div>
                    <div class="row mb-3">
                         <div class="col-md-6">
                              <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="state" name="state" placeholder="State">
                         </div>
                         <div class="col-md-6">
                              <label for="pincode" class="form-label">Pincode <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="pincode" name="pincode" placeholder="pincode">
                         </div>
                    </div>
                    <div class="row mb-3">
                         <div class="col-md-6">
                              <label for="profession" class="form-label">Profession <span
                                        class="text-danger">*</span></label>
                              <select class="form-select" id="profession" name="profession">
                                   <option selected>Select One</option>
                                   <option value="Student">Student</option>
                                   <option value="Self-Employed">Self-Employed</option>
                                   <option value="salaried">salaried</option>
                                   <option value="Other">Other</option>
                              </select>
                         </div>
                         <div class="col-md-6">
                              <label for="maritalStatus" class="form-label">Marital Status <span
                                        class="text-danger">*</span></label>
                              <select class="form-select" id="maritalStatus" name="maritalStatus">
                                   <option selected>Select One</option>
                                   <option value="Single">Single</option>
                                   <option value="Married">Married</option>
                              </select>
                         </div>
                    </div>
                    <div class="mb-3">
                         <label for="creditSource" class="form-label">Credit Source <span
                                   class="text-danger">*</span></label>
                         <input type="text" class="form-control" id="creditSource" name="creditSource"
                              placeholder="Credit Source">
                    </div>
                    <div class="mb-3">
                         <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                         <textarea class="form-control" id="address" name="address" rows="3"
                              placeholder="Enter Address"></textarea>
                    </div>
                    <div class="mb-3">
                         <label for="photo" class="form-label">Photo <span class="text-danger">*</span></label>
                         <div class="border rounded p-4 text-center" style="border-style: dashed; cursor: pointer;">
                              <input type="file" id="photo" name="photo" class="form-control d-none">
                              <div>
                                   <i class="bi bi-cloud-arrow-up" style="font-size: 2rem; color: #6c757d;"></i>
                                   <p class="mt-2 mb-0 text-muted">Drag and drop a file here or <span
                                             class="text-primary"
                                             onclick="document.getElementById('photo').click();">click</span> to upload
                                   </p>
                              </div>
                         </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
               </form>
          </div>
     </div>

     <!-- Right Side: Members Details -->
     <div class="col-md-6">
          <div class="bg-light rounded h-100 p-4">
               <h4 class="mb-4">Members Details</h4>
               <table class="table table-striped">
                    <thead>
                         <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Group Name</th>
                              <th scope="col">Action</th>
                         </tr>
                    </thead>
                    <tbody>
                         @foreach ($members as $m)
                         <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{$m->name}}</td>
                              <td>{{$m->groupname}}</td>
                              <td></td>
                         </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
</div>
@endsection