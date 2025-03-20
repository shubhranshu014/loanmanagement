<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <title>NEELANSHU FINANCE</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport">
     <meta content="" name="keywords">
     <meta content="" name="description">

     <!-- Favicon -->
     <link href="img/favicon.ico" rel="icon">

     <!-- Google Web Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

     <!-- Icon Font Stylesheet -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

     <!-- Libraries Stylesheet -->
     <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
     <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

     <!-- Customized Bootstrap Stylesheet -->
     <link href="/asset/css/bootstrap.min.css" rel="stylesheet">

     <!-- Template Stylesheet -->
     <link href="/asset/css/style.css" rel="stylesheet">
</head>

<body>

     <div class="position-relative d-flex bg-white p-0 container-xxl">
          <!-- Spinner Start -->
          <div id="spinner"
               class="top-50 position-fixed d-flex align-items-center justify-content-center bg-white w-100 vh-100 translate-middle show start-50">
               <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
               </div>
          </div>
          <!-- Spinner End -->


          <!-- Sidebar Start -->
          <div class="pe-4 pb-3 sidebar">
               <nav class="bg-light navbar navbar-light">
                    <a href="index.html" class="mx-4 mb-3 navbar-brand">
                         <i class="me-2 fa fa-hashtag"></i>
                         <h3 class="text-primary fs-5">Neelanshu finance</h3>
                    </a>
                    <div class="d-flex align-items-center ms-4 mb-4">
                         <div class="position-relative">
                              <img class="rounded-circle" src="{{asset('/asset/images/user.jpg')}}" alt=""
                                   style="width: 40px; height: 40px;">
                              <div
                                   class="bottom-0 position-absolute bg-success p-1 border-2 border-white rounded-circle end-0">
                              </div>
                         </div>
                         <div class="ms-3">
                              <h6 class="mb-0">{{auth()->user()->name}}</h6>
                              <span class="text-uppercase">{{auth()->user()->role}}</span>
                         </div>
                    </div>
                    <div class="w-100 navbar-nav">
                         <a href="{{route('admin.dashboard')}}" class="nav-item nav-link active"><i
                                   class="me-2 fa fa-tachometer-alt"></i>Dashboard</a>
                         <div class="nav-item dropdown">
                              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                        class="fa-laptop me-2 fa"></i>Management</a>
                              <div class="bg-transparent border-0 dropdown-menu">
                                   <a href="{{route('admin.add.branch')}}" class="dropdown-item">Add Branch</a>
                                   <a href="{{route('admin.add.loanofficer')}}" class="dropdown-item">Add Loan
                                        Officer</a>
                              </div>
                         </div>
                         <a href="{{route('admin.details.loanproduct')}}" class="nav-item nav-link"><i class="me-2 fa fa-th"></i>Loan Product</a>
                         <a href="{{route('admin.loan.details')}}" class="nav-item nav-link"><i class="me-2 fa fa-keyboard"></i>Loan Approve</a>
                    </div>
               </nav>
          </div>
          <!-- Sidebar End -->
          <!-- Content Start -->
          <div class="content">
               <!-- Navbar Start -->
               <nav class="sticky-top bg-light px-4 py-0 navbar navbar-expand navbar-light">
                    <a href="index.html" class="d-flex me-4 navbar-brand d-lg-none">
                         <h2 class="mb-0 text-primary"><i class="fa fa-hashtag"></i></h2>
                    </a>
                    <a href="#" class="flex-shrink-0 sidebar-toggler">
                         <i class="fa fa-bars"></i>
                    </a>
                    <form class="d-md-flex ms-4 d-none">
                         <input class="form-control border-0" type="search" placeholder="Search">
                    </form>
                    <div class="align-items-center ms-auto navbar-nav">
                         <div class="nav-item dropdown">
                              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                   <i class="me-lg-2 fa fa-envelope"></i>
                                   <span class="d-lg-inline-flex d-none">Message</span>
                              </a>
                              <div
                                   class="bg-light m-0 border-0 rounded-0 rounded-bottom dropdown-menu dropdown-menu-end">
                                   <a href="#" class="dropdown-item">
                                        <div class="d-flex align-items-center">
                                             <img class="rounded-circle" src="img/user.jpg" alt=""
                                                  style="width: 40px; height: 40px;">
                                             <div class="ms-2">
                                                  <h6 class="mb-0 fw-normal">Jhon send you a message</h6>
                                                  <small>15 minutes ago</small>
                                             </div>
                                        </div>
                                   </a>
                                   <hr class="dropdown-divider">
                                   <a href="#" class="dropdown-item">
                                        <div class="d-flex align-items-center">
                                             <img class="rounded-circle" src="img/user.jpg" alt=""
                                                  style="width: 40px; height: 40px;">
                                             <div class="ms-2">
                                                  <h6 class="mb-0 fw-normal">Jhon send you a message</h6>
                                                  <small>15 minutes ago</small>
                                             </div>
                                        </div>
                                   </a>
                                   <hr class="dropdown-divider">
                                   <a href="#" class="dropdown-item">
                                        <div class="d-flex align-items-center">
                                             <img class="rounded-circle" src="img/user.jpg" alt=""
                                                  style="width: 40px; height: 40px;">
                                             <div class="ms-2">
                                                  <h6 class="mb-0 fw-normal">Jhon send you a message</h6>
                                                  <small>15 minutes ago</small>
                                             </div>
                                        </div>
                                   </a>
                                   <hr class="dropdown-divider">
                                   <a href="#" class="text-center dropdown-item">See all message</a>
                              </div>
                         </div>
                         <div class="nav-item dropdown">
                              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                   <i class="me-lg-2 fa fa-bell"></i>
                                   <span class="d-lg-inline-flex d-none">Notificatin</span>
                              </a>
                              <div
                                   class="bg-light m-0 border-0 rounded-0 rounded-bottom dropdown-menu dropdown-menu-end">
                                   <a href="#" class="dropdown-item">
                                        <h6 class="mb-0 fw-normal">Profile updated</h6>
                                        <small>15 minutes ago</small>
                                   </a>
                                   <hr class="dropdown-divider">
                                   <a href="#" class="dropdown-item">
                                        <h6 class="mb-0 fw-normal">New user added</h6>
                                        <small>15 minutes ago</small>
                                   </a>
                                   <hr class="dropdown-divider">
                                   <a href="#" class="dropdown-item">
                                        <h6 class="mb-0 fw-normal">Password changed</h6>
                                        <small>15 minutes ago</small>
                                   </a>
                                   <hr class="dropdown-divider">
                                   <a href="#" class="text-center dropdown-item">See all notifications</a>
                              </div>
                         </div>
                         <div class="nav-item dropdown">
                              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                   <img class="me-lg-2 rounded-circle" src="{{asset('/asset/images/user.jpg')}}" alt=""
                                        style="width: 40px; height: 40px;">
                                   <span class="d-lg-inline-flex d-none">{{auth()->user()->name}}</span>
                              </a>
                              <div
                                   class="bg-light m-0 border-0 rounded-0 rounded-bottom dropdown-menu dropdown-menu-end">
                                   <a href="#" class="dropdown-item">My Profile</a>
                                   <a href="#" class="dropdown-item">Settings</a>
                                   <a href="#" class="dropdown-item"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Log Out
                                   </a>

                                   <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                        style="display: none;">
                                        @csrf
                                   </form>

                              </div>
                         </div>
                    </div>
               </nav>

               <div class="px-4 pt-4 container-fluid">
                    @yield("admin")

                    <!-- Footer Start -->
                    <div class="mt-4 mb-1">
                         <div class="bg-light p-4 rounded-top">
                              <div class="row">
                                   <div class="col-sm-6 text-sm-start text-center col-12">
                                        &copy; <a href="#">NEELANSHU FINANCE</a>, All Right Reserved.
                                   </div>
                                   <div class="col-sm-6 text-sm-end text-center col-12">
                                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                                        Designed By <a href="https://htmlcodex.com">Ashish & Partners</a>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- Footer End -->
               </div>

          </div>
     </div>

     <!-- JavaScript Libraries -->
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
     <script src="/asset/lib/chart/chart.min.js"></script>
     <script src="/asset/lib/easing/easing.min.js"></script>
     <script src="/asset/lib/waypoints/waypoints.min.js"></script>
     <script src="/asset/lib/owlcarousel/owl.carousel.min.js"></script>
     <script src="/asset/lib/tempusdominus/js/moment.min.js"></script>
     <script src="/asset/lib/tempusdominus/js/moment-timezone.min.js"></script>
     <script src="/asset/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

     <!-- Template Javascript -->
     <script src="/asset/js/main.js"></script>
</body>

</html>