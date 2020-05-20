<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title }} | {{ ucfirst($category) }} - {{ $subtitle }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('assets.top')
</head>
<body>
    <div class="navbar navbar-expand-md header-menu-one bg-light">
        <div class="nav-bar-header-one">
            <div class="header-logo">
                <a href="/">
                    &nbsp;&nbsp;&nbsp;<img src="{{ asset('img/logopsts.png') }}" alt="">
                </a>
            </div>
        </div>
        <div class="d-md-none mobile-nav-bar">
            <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
            <ul class="navbar-nav">

            </ul>
            <ul class="navbar-nav">
                <li class="navbar-item dropdown header-admin">
                    <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        <div class="admin-title">
                            <h5 class="item-title">{{ $nama }}</h5>
                            <span>{{ $identity }}</span>
                        </div>
                        <div class="admin-img">
                            <img src="{{ asset('img/figure/default-user.jpg') }}" alt="Admin">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="item-header">
                            <h6 class="item-title">{{ $nama }}</h6>
                        </div>
                        <div class="item-content">
                            <ul class="settings-list">
                                @if ($category != 'tamu' && $category != 'admin')
                                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#biodata-saya"><i class="far fa-table"></i>Biodata Saya</a></li>
                                @endif
                                @if ($category == 'dosen')
                                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#role-saya"><i class="far fa-user"></i>Role Saya</a></li>
                                @endif
                                @if ($category != 'tamu')
                                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#ubah-password"><i class="far fa-key"></i>Ubah Password</a></li>
                                @endif
                                <li><a href="{{ route('auth.logout') }}"><i class="flaticon-turn-off"></i>Keluar</a></li>
                            </ul>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <div class="dashboard-page-one">
        @include('main.sidebar')
        @yield('content') 
    </div>
    @include('assets.bottom')
</body>
</html>