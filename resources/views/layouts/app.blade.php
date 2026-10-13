<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SDN MOCH TOHA | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="{{ asset('assets/img/sekolah/logo.png') }}" type="image/x-icon">

    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">

    @stack('styles')
</head>

@php
    $profile = \App\Models\ProfileSekolah::first();
@endphp

<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <div class="logo-header" data-background-color="dark">
                    <a href="{{ route('admin.dashboard') }}"
                        class="logo d-flex align-items-center text-decoration-none">
                        <img src="{{ $profile && $profile->logo ? asset('storage/profil/' . $profile->logo) : asset('assets/img/sekolah/logo.png') }}"
                            alt="Logo" style="width:40px;height:40px;object-fit:contain;">
                        <span class="text-white fw-bold ms-2">
                            {{ $profile?->nama_sekolah ?? 'SDN MOCH TOHA' }}
                        </span>
                    </a>

                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>

                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
            </div>

            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">

                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fas fa-th-large"></i>
                            </span>
                            <h4 class="text-section">MENU UTAMA</h4>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @if (auth()->user()->role === 'Admin')
                            <li class="nav-item {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                                <a href="{{ route('admin.profile') }}">
                                    <i class="fas fa-school"></i>
                                    <p>Profile Sekolah</p>
                                </a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('admin.guru*') ? 'active' : '' }}">
                                <a href="{{ route('admin.guru.index') }}">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <p>Data Guru</p>
                                </a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('admin.siswa*') ? 'active' : '' }}">
                                <a href="{{ route('admin.siswa.index') }}">
                                    <i class="fas fa-user-graduate"></i>
                                    <p>Data Siswa</p>
                                </a>
                            </li>


                            <li class="nav-item {{ request()->routeIs('admin.user*') ? 'active' : '' }}">
                                <a href="{{ route('admin.user.index') }}">
                                    <i class="fas fa-users-cog"></i>
                                    <p>Kelola User</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-section mt-3">
                            <span class="sidebar-mini-icon">
                                <i class="fas fa-layer-group"></i>
                            </span>
                            <h4 class="text-section">KONTEN SEKOLAH</h4>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.berita*') ? 'active' : '' }}">
                            <a href="{{ route('admin.berita.index') }}">
                                <i class="fas fa-newspaper"></i>
                                <p>Berita</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}">
                            <a href="{{ route('admin.galeri.index') }}">
                                <i class="fas fa-images"></i>
                                <p>Galeri</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.ekstrakurikuler*') ? 'active' : '' }}">
                            <a href="{{ route('admin.ekstrakurikuler.index') }}">
                                <i class="fas fa-star"></i>
                                <p>Ekstrakurikuler</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="main-panel">

            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{ route('admin.dashboard') }}" class="logo">
                            <img src="{{ asset('assets/img/sekolah/logo.png') }}" alt="Logo" class="navbar-brand"
                                style="width:32px;height:32px;object-fit:contain;">
                        </a>

                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>

                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                </div>

                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">

                                    <div
                                        class="avatar-sm rounded bg-primary d-flex align-items-center justify-content-center text-white fw-bold fs-2">
                                        {{ auth()->user()->role === 'Admin' ? 'A' : 'O' }}
                                    </div>

                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">
                                            {{ auth()->user()->username ?? 'Admin' }}
                                        </span>
                                    </span>
                                </a>

                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">

                                        <li>
                                            <div class="user-box">
                                                <div
                                                    class="avatar-lg rounded bg-primary d-flex align-items-center justify-content-center text-white fw-bold fs-2">
                                                    {{ auth()->user()->role === 'Admin' ? 'A' : 'O' }}
                                                </div>

                                                <div class="u-text">
                                                    <h4>{{ auth()->user()->username ?? 'User' }}</h4>
                                                    <p class="text-muted">
                                                        {{ auth()->user()->role ?? 'User' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <div class="dropdown-divider"></div>

                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-sign-out-alt me-2"></i>
                                                    Logout
                                                </button>
                                            </form>
                                        </li>

                                    </div>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>

            <div class="container">
                <div class="page-inner">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="text-muted">
                            <i class="fas fa-school me-1"></i>
                            <strong>SDN MOCH TOHA</strong>
                        </div>

                        <div class="text-muted">
                            &copy; {{ date('Y') }} SDN MOCH TOHA
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    @stack('scripts')

</body>

</html>
