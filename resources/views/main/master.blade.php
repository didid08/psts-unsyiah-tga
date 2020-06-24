<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ $title }} | {{ ucfirst($category) }} - {{ $subtitle }}</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  {{--<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">--}}
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('custom-style')
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white p-3">
    <div class="container">
      <a href="/" class="navbar-brand">
        <img src="{{ asset('dist/img/logo-unsyiah-2.png') }}" alt="{{ $title }} Logo" class="brand-image"
             style="opacity: .8" width="40em">
        <span class="brand-text font-weight-bold text-muted ml-2">{{ $title }}</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ route('main.dashboard') }}" class="nav-link{{ $nav_item_active == 'dashboard' ? ' text-bold' : '' }}">Dashboard</a>
          </li>
          @if ($category != 'tamu')
            @if (isset($role->admin) | isset($role->koor_prodi) | isset($role->koor_tga) | isset($role->mhs))
              <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link{{ $nav_item_active == 'tga' ? ' text-bold' : '' }} dropdown-toggle">TGA</a>
                <ul class="dropdown-menu border-0 shadow">
                  <li><a href="{{ route('main.tga.disposisi') }}" class="dropdown-item">Disposisi</a></li>
                  @if (isset($role->mhs))
                    <li><a href="{{ route('main.tga.mahasiswa.input-usul') }}" class="dropdown-item">Input Usul TGA</a></li>
                    <li><a href="#" class="dropdown-item">Input Usul Seminar Proposal</a></li>
                    <li><a href="#" class="dropdown-item">Input Usul Sidang</a></li>
                    <li><a href="#" class="dropdown-item">Input Usul Yudisium</a></li>
                  @elseif (isset($role->admin))
                    <li><a href="{{ route('main.tga.admin.usulan-tga') }}" class="dropdown-item">Usulan TGA</a></li>
                    <li><a href="#" class="dropdown-item">Usulan SK Pembimbing</a></li>
                    <li><a href="#" class="dropdown-item">Usulan Surat Tugas Pengambilan Data</a></li>
                    <li><a href="#" class="dropdown-item">Usulan Seminar Proposal</a></li>
                    <li><a href="#" class="dropdown-item">Usulan SK Penguji Seminar Proposal</a></li>
                    <li><a href="#" class="dropdown-item">Usulan Pengesahan Seminar Proposal</a></li>
                    <li><a href="#" class="dropdown-item">Usulan Sidang</a></li>
                    <li><a href="#" class="dropdown-item">Usulan SK Penguji Sidang</a></li>
                    <li><a href="#" class="dropdown-item">Usulan Pengesahan Sidang</a></li>
                    <li><a href="#" class="dropdown-item">Usulan Yudisium</a></li>
                  @elseif (isset($role->koor_prodi))
                    <li><a href="#" class="dropdown-item">Persetujuan Usulan TGA</a></li>
                    <li><a href="#" class="dropdown-item">Penetapan SK Pembimbing</a></li>
                    <li><a href="#" class="dropdown-item">Persetujuan Surat Tugas Pengambilan Data</a></li>
                    <li><a href="#" class="dropdown-item">Penetapan SK Penguji Seminar Proposal</a></li>
                    <li><a href="#" class="dropdown-item">Pengesahan Seminar Proposal</a></li>
                    <li><a href="#" class="dropdown-item">Penetapan SK Penguji Sidang</a></li>
                    <li><a href="#" class="dropdown-item">Pengesahan Sidang</a></li>
                    <li><a href="#" class="dropdown-item">Pengesahan Usulan Yudisium</a></li>
                  @elseif (isset($role->koor_tga))
                    <li><a href="#" class="dropdown-item">Usulan Seminar Proposal</a></li>
                    <li><a href="#" class="dropdown-item">Usulan Sidang</a></li>
                  @endif
                </ul>
              </li>
            @else
              <li class="nav-item">
                <a href="#" class="nav-link{{ $nav_item_active == 'tga' ? ' text-bold' : '' }}">TGA</a>
              </li>
            @endif
            <li class="nav-item">
              <a href="#" class="nav-link{{ $nav_item_active == 'biodata' ? ' text-bold' : '' }}">Biodata</a>
            </li>
          @endif
          <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link{{ $nav_item_active == 'dosen' ? ' text-bold' : '' }} dropdown-toggle">Dosen</a>
            <ul class="dropdown-menu border-0 shadow">
              <li><a href="{{ route('main.dosen.info') }}" class="dropdown-item">Info Dosen</a></li>
              <li><a href="{{ route('main.dosen.rekap') }}" class="dropdown-item">Rekap Dosen</a></li>
            </ul>
          </li>

          @if (in_array($category, ['admin', 'mahasiswa']))
            <li class="nav-item">
              <a href="#" class="nav-link{{ $nav_item_active == 'nilai-mahasiswa' ? ' text-bold' : '' }}">Nilai Mahasiswa</a>
            </li>
          @endif
        </ul>

        {{-- <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form> --}}
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        {{-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li> --}}
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item dropdown ml-2 align-middle" id="user-info">
            <a class="nav-link" data-toggle="dropdown" href="#" style="display: inline;">
              <span class="text-bold"><b>{{ $nama }}</b>&nbsp;</span>
              <i class="fas fa-caret-down"></i>
              <!--<img src="{{ asset('dist/img/figure/default-user.jpg') }}" class="img-circle elevation-2 ml-2" alt="User Image">-->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-header">
                <h5>{{ $nama }}</h5>
                {{ $identity }}
              </span>
              @if ($category != 'tamu')
                <div class="dropdown-divider"></div>
                @if ($category != 'admin')
                  <a href="#" class="dropdown-item">
                    <i class="far fa-user mr-2"></i> Biodata
                  </a>
                  <a href="#" class="dropdown-item">
                    <i class="far fa-star mr-2"></i> Role Saya
                  </a>
                @endif
                <a href="#" class="dropdown-item">
                  <i class="fa fa-key mr-2"></i> Ubah Password
                </a>
              @endif
              <div class="dropdown-divider"></div>
              <a href="{{ route('auth.logout') }}" class="dropdown-item text-danger">
                <i class="fa fa-door-open mr-2"></i> Keluar
              </a>
            </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> {{ $subtitle }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            {{--<ol class="breadcrumb float-sm-right">
              @yield('breadcumb')
            </ol>--}}
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content pb-4">
      @yield('content')
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      PSTS Unsyiah (TGA) v1.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date('Y') }} <a href="https://technosaber.com">Technosaber</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
@if ( session('error') != null | session('warning') != null | session('success') != null | $errors->any() )
  <script>
    $(document).ready(function () {
      @if (session('error'))
        toastr.error('{{ session('error') }}')
      @endif
      @if (session('warning'))
        toastr.warning('{{ session('warning') }}')
      @endif
      @if (session('success'))
        toastr.success('{{ session('success') }}')
      @endif
      @if ($errors->any())
        var timeout = 0
        @foreach ($errors->all() as $error)
          setTimeout(function () {
            toastr.error('{{$error}}')
          }, timeout)
          timeout = timeout+300
        @endforeach
      @endif
    });
  </script>
@endif
@yield('custom-script')
</body>
</html>
