<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin Free Bootstrap Admin Dashboard Template</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ url('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ url('assets/vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ url('assets/vendors/iconfonts/font-awesome/css/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ url('assets/vendors/icheck/skins/all.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
  <!-- endinject -->
  {{-- <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}" /> --}}

  <!--  kiki css-->
  <!-- tidak kompatibel -->
  <!-- <link rel="stylesheet" href="kikistyle.css"> -->
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo text-dark" href="#">
          SISPEK
        </a>
        <a class="navbar-brand brand-logo-mini text-dark" href="#">
          <i class="menu-icon fa fa-cog fa-spin"></i>
        </a>
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center">
        <span class="navbar-text ml-2 mr-auto font-mega">Sistem Informasi Pelaporan Akuntansi</span>
        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, {{ Auth::user()->nama }} !</span>
              <i class="fa fa-user-circle-o"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    {{ Auth::user()->kategori }}
                  </div>
                </div>
              </a>
              <a class="dropdown-item mt-2" href="{{ url('profil/'.Auth::user()->id) }}">
                Manage Accounts
              </a>
              <a class="dropdown-item" href="{{ url('logout') }}">
                Sign Out
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->

    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      

      @include('layouts.navbar') {{-- ('view.name', ['some' => 'data']) --}}

      <!-- partial -->
      <div class="main-panel">


        <div class="content-wrapper">
          <!-- disini -->

          @yield('content')

          <!-- disini -->
        </div>



        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
              <a href="#" target="_blank">Moh Zulkifli Katili & Moh Ilham Akbar</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Our Homework & made with
                <i class="mdi mdi-heart text-danger"></i>
              </span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ url('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ url('assets/js/off-canvas.js') }}"></script>
    <script src="{{ url('assets/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ url('assets/js/dashboard.js') }}"></script>
    {{-- <script src="{{ url('assets/js/hitung_halaman_transaksi.js') }}"></script><!-- Kikipunya--> --}}
    <!-- End custom js for this page-->

    @yield('script halaman')




  </body>
  </html>