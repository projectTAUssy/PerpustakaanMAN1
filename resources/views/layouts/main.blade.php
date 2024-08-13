<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>E-LIBRARY</title>
  <meta name="description" content="" />
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
  <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
  <!-- Page CSS -->
  <!-- Helpers -->
  <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('assets/js/config.js') }}"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
  <style>
    .dataTables_filter {
      margin-bottom: 15px !important;
    }
    .dt-input {
      margin-right: 15px !important;
    }
    .alert {
      position: fixed;
      top: 50px;
      right: 50%;
      transform: translateX(50%);
      width: max-content;
      z-index: 9999;
      padding: 1rem 1.5rem;
      border-radius: 0.375rem;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .alert .btn-close {
      margin-left: 20px;
    }
    .menu-item.active > a {
      background-color: #006316;
      color: #fff;
    }
    .menu-item > a {
      display: flex;
      align-items: center;
      padding: 1rem 1.5rem;
      border-radius: 0.375rem;
      font-weight: 500;
      color: #000;
      text-decoration: none;
    }
    .menu-item > a:hover {
      background-color: #f0f0f0;
      margin-top: 20px;
    }
    .menu-icon {
      font-size: 1.25rem;
      margin-right: 0.75rem;
      color: #000; /* Ensure icons are black */
    }
    .menu-inner {
      margin: 0;
    }
    .menu-inner li {
      margin-bottom: 0.5rem;
    }
    .text-black {
      color: #000 !important;
    }
  </style>
</head>
<body>
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible fade show text-center" id="alert" role="alert">
    <h5 class="text-black">{{ $message }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo d-flex" style="height:100px">
          <a href="/" class="app-brand-link m-auto">
            <span class="app-brand-logo demo">
              <img src="{{ asset('assets/img/logo.svg') }}" alt="" style="width: 100px">
            </span>
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>
        <div class="menu-inner-shadow"></div>
        <ul class="menu-inner py-1" style="margin-top:30px">
          <li class="menu-item">
            <a href="{{ route('dashboard') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-alt"></i>
              <div data-i18n="Dashboard" class="text-black">Dashboard</div>
            </a>
          </li>
          <li class="menu-item {{ Route::is('users*') ? 'active' : '' }}" style="margin-top:20px">
            <a href="{{ route('users.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-user"></i>
              <div data-i18n="Users" class="text-black">Daftar Anggota</div>
            </a>
          </li>
          <li class="menu-item" style="margin-top:20px">
            <a href="/peminjaman" class="menu-link">
              <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
              <div data-i18n="Peminjaman Buku" class="text-black">Peminjaman Buku</div>
            </a>
          </li>
          <li class="menu-item {{ Route::is('peminjaman_kelas*') ? 'active' : '' }}" style="margin-top:20px">
            <a href="/peminjaman-kelas" class="menu-link">
              <i class="menu-icon tf-icons bx bx-chalkboard"></i>
              <div data-i18n="Peminjaman Kelas" class="text-black">Peminjaman Kelas</div>
            </a>
          </li>
          <li class="menu-item {{ Route::is('pengembalian*') ? 'active' : '' }}" style="margin-top:20px">
            <a href="/pengembalian" class="menu-link">
              <i class="menu-icon tf-icons bx bx-recycle"></i>
              <div data-i18n="Pengembalian Buku" class="text-black">Pengembalian Buku</div>
            </a>
          </li>
          <li class="menu-item {{ Route::is('bukus*') ? 'active' : '' }}" style="margin-top:20px">
            <a href="/bukus" class="menu-link">
              <i class="menu-icon tf-icons bx bx-book"></i>
              <div data-i18n="Daftar Buku" class="text-black">Daftar Buku</div>
            </a>
          </li>
          <li class="menu-item {{ Route::is('visits*') ? 'active' : '' }}" style="margin-top:20px">
            <a href="/pengunjung" class="menu-link">
              <i class="menu-icon tf-icons bx bx-user-check"></i>
              <div data-i18n="Daftar Kunjungan" class="text-black">Daftar Kunjungan</div>
            </a>
          </li>
          <li class="menu-item {{ Route::is('laporan*') ? 'active' : '' }}" style="margin-top:20px">
            <a href="/Laporan" class="menu-link">
              <i class="menu-icon tf-icons bx bx-file"></i>
              <div data-i18n="Laporan" class="text-black">Laporan</div>
            </a>
          </li>
          <li class="menu-item {{ Route::is('rak_bukus*') ? 'active' : '' }}" style="margin-top:20px">
            <a href="/rak_bukus" class="menu-link">
              <i class="menu-icon tf-icons bx bx-book-content"></i>
              <div data-i18n="Rak Buku" class="text-black">Rak Buku</div>
            </a>
          </li>
        </ul>
      </aside>
      <div class="layout-page">
      <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center" style="background-color: #006316 !important; width: 100%; margin-top:-1px" id="layout-navbar">
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>
          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <li class="nav-item mt-1 text-white">Halo {{ Auth::user()->name }} !</li>
              <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="dropdown-item text-white">
                    <span class="align-middle">Log Out</span>
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </nav>
        <div class="content-wrapper">
          @yield('content')
          <footer class="content-footer footer bg-footer-theme">
            <p class="text-center">Copyright @ 2024 E-Library</p>
          </footer>
          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
  <script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
  </script>
</body>
</html>
