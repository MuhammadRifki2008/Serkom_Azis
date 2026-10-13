<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }} | @yield('title')</title>

    <link rel="icon"
        href="{{ $profile && $profile->logo ? asset('storage/profil/' . $profile->logo) : asset('assets/img/sekolah/logo.png') }}"
        type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">

    <style>
        .hero {
            min-height: 550px;
            background: linear-gradient(rgba(13, 71, 161, .78), rgba(11, 47, 107, .85)),
                url('{{ asset('assets/img/sekolah/FotoSekolah.png') }}') center/cover;
        }

        .hero-content {
            max-width: 750px;
        }

        .hero-title {
            font-size: 52px;
            font-weight: 700;
        }

        .school-image {
            width: 100%;
            height: 420px;
            object-fit: cover;
        }

        .teacher-image {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }

        .news-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .gallery-image {
            width: 100%;
            height: 260px;
            object-fit: cover;
        }

        .video-box {
            height: 260px;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .video-box i {
            font-size: 55px;
        }

        .page-header {
            background: #0d47a1;
        }

        .footer {
            background: #0b2f6b;
        }

        @media (max-width: 767px) {
            .hero {
                min-height: 500px;
            }

            .hero-title {
                font-size: 36px;
            }

            .school-image {
                height: 280px;
            }

            .teacher-image,
            .gallery-image,
            .video-box {
                height: 230px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-primary" href="{{ route('public.dashboard') }}">
            @if($profile && $profile->logo)
                <img src="{{ asset('storage/profil/' . $profile->logo) }}"
                     alt="{{ $profile->nama_sekolah }}"
                     width="45"
                     height="45"
                     class="object-fit-contain">
            @else
                <img src="{{ asset('assets/img/sekolah/logo.png') }}"
                     alt="Logo Sekolah"
                     width="45"
                     height="45"
                     class="object-fit-contain">
            @endif

            <span>{{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPublic">
            <i class="fas fa-bars text-primary"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarPublic">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.dashboard') ? 'active text-primary fw-semibold' : '' }}"
                       href="{{ route('public.dashboard') }}">
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.profile') ? 'active text-primary fw-semibold' : '' }}"
                       href="{{ route('public.profile') }}">
                        Profil
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.guru') ? 'active text-primary fw-semibold' : '' }}"
                       href="{{ route('public.guru') }}">
                        Guru
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.berita') ? 'active text-primary fw-semibold' : '' }}"
                       href="{{ route('public.berita') }}">
                        Berita
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.galeri') ? 'active text-primary fw-semibold' : '' }}"
                       href="{{ route('public.galeri') }}">
                        Galeri
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.ekstrakurikuler') ? 'active text-primary fw-semibold' : '' }}"
                       href="{{ route('public.ekstrakurikuler') }}">
                        Ekstrakurikuler
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.ujikom') ? 'active text-primary fw-semibold' : '' }}"
                       href="{{ route('public.ujikom') }}">
                        Uji Kompetensi
                    </a>

                </li>

                <li class="nav-item">
                    <a href=" {{('login')}}" class="btn btn-primary ">Login</a>
                </li>

            </ul>
        </div>

    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="footer text-white mt-5">
    <div class="container py-5">

        <div class="row g-4">

            <div class="col-lg-5 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">

                    @if($profile && $profile->logo)
                        <img src="{{ asset('storage/profil/' . $profile->logo) }}"
                             alt="{{ $profile->nama_sekolah }}"
                             width="45"
                             height="45"
                             class="object-fit-contain">
                    @else
                        <img src="{{ asset('assets/img/sekolah/logo.png') }}"
                             alt="Logo Sekolah"
                             width="45"
                             height="45"
                             class="object-fit-contain">
                    @endif

                    <h5 class="mb-0 fw-bold">
                        {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}
                    </h5>

                </div>

                <p class="text-white-50 mb-0">
                    {{ $profile->deskripisi ?? 'Website resmi sekolah sebagai media informasi dan dokumentasi kegiatan pendidikan.' }}
                </p>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3">Menu</h5>

                <ul class="list-unstyled">

                    <li class="mb-2">
                        <a href="{{ route('public.dashboard') }}" class="text-white-50 text-decoration-none">
                            Beranda
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('public.profile') }}" class="text-white-50 text-decoration-none">
                            Profil
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('public.guru') }}" class="text-white-50 text-decoration-none">
                            Guru
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('public.berita') }}" class="text-white-50 text-decoration-none">
                            Berita
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('public.galeri') }}" class="text-white-50 text-decoration-none">
                            Galeri
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('public.ekstrakurikuler') }}" class="text-white-50 text-decoration-none">
                            Ekstrakurikuler
                        </a>
                    </li>

                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold mb-3">Kontak</h5>

                <p class="text-white-50 mb-2">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    {{ $profile->alamat ?? 'Alamat sekolah belum tersedia' }}
                </p>

                <p class="text-white-50 mb-2">
                    <i class="fas fa-phone me-2"></i>
                    {{ $profile->kontak ?? 'Kontak sekolah belum tersedia' }}
                </p>

                <p class="text-white-50 mb-0">
                    <i class="fas fa-school me-2"></i>
                    {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}
                </p>
            </div>

        </div>

        <hr class="border-light opacity-25 my-4">

        <div class="text-center">
            <p class="text-white-50 mb-0">
                &copy; {{ date('Y') }}
                {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}
                . All Rights Reserved.
            </p>
        </div>

    </div>
</footer>

<script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.bundle.min.js') }}"></script>

@stack('scripts')

</body>
</html>
