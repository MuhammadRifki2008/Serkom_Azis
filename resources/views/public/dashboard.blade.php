@extends('layouts.public')
@section('title', 'Beranda')

@push('styles')
    <style>
        .hero-home {
            height: 530px;
            background: linear-gradient(rgba(0, 0, 0, .38), rgba(0, 70, 45, .55)), url('{{ asset('assets/img/sekolah/FotoSekolah.png') }}') center/cover;
        }

        .hero-home-content {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }

        .hero-home-content h1 {
            font-size: 52px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .hero-home-content h3 {
            font-size: 27px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .hero-home-content p {
            font-size: 18px;
            margin: 4px 0;
        }

        .school-stats {
            margin-top: -35px;
            position: relative;
            z-index: 5;
            padding-bottom: 30px;
        }

        .school-stats-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            padding: 28px 20px;
        }

        .school-stat {
            text-align: center;
            border-right: 1px solid #e5e5e5;
        }

        .school-stat:last-child {
            border-right: 0;
        }

        .school-stat h2 {
            color: #194987;
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .school-stat span {
            color: #777;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .section-label {
            color: #e59a00;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 15px;
        }

        .section-line {
            width: 220px;
            height: 4px;
            background: linear-gradient(to right, #e59a00, #f5ead5);
            border-radius: 10px;
            margin-top: 12px;
        }

        .home-card-link {
            display: block;
            height: 100%;
            text-decoration: none;
            color: inherit;
        }

        .home-card-link .card {
            height: 100%;
            border-radius: 12px;
            overflow: hidden;
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .home-card-link:hover .card {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, .12) !important;
        }

        .home-card-link:focus-visible {
            outline: 3px solid #194987;
            outline-offset: 4px;
            border-radius: 12px;
        }

        .home-card-photo {
            width: 100%;
            object-fit: cover;
            display: block;
        }

        .home-teacher-photo {
            height: 405px;
        }

        .home-news-photo {
            height: 230px;
        }

        .home-eskul-photo {
            height: 240px;
        }

        .home-gallery-photo {
            height: 250px;
        }

        .home-card-title {
            color: #194987;
            font-weight: 700;
        }

        .home-card-text {
            color: #666;
            font-size: 14px;
            line-height: 1.7;
        }

        .home-section {
            padding: 50px 0;
        }

        @media (max-width: 767px) {
            .hero-home {
                height: 480px;
            }

            .hero-home-content h1 {
                font-size: 34px;
            }

            .hero-home-content h3 {
                font-size: 20px;
            }

            .hero-home-content p {
                font-size: 14px;
            }

            .school-stat:nth-child(2) {
                border-right: 0;
            }

            .school-stat {
                margin-bottom: 20px;
            }

            .home-section {
                padding: 35px 0;
            }

            .home-teacher-photo {
                height: 250px;
            }

            .home-news-photo,
            .home-eskul-photo,
            .home-gallery-photo {
                height: 190px;
            }

            .section-line {
                width: 180px;
            }
        }
    </style>
@endpush

@section('content')

    <section class="hero-home">
        <div class="hero-home-content">
            <div class="container">
                <h1>{{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}</h1>
                <h3>Sekolah Dasar Negeri Moch Toha</h3>
                <p>Berilmu, Berkarakter dan Berprestasi</p>
                <p>Unggul dalam Pendidikan</p>
                <p>Membangun Generasi Masa Depan</p>
            </div>
        </div>
    </section>

    <section class="school-stats">
        <div class="container">
            <div class="school-stats-card">
                <div class="row align-items-center">
                    <div class="col-6 col-lg-3 school-stat">
                        <h2>A</h2>
                        <span>Akreditasi</span>
                    </div>
                    <div class="col-6 col-lg-3 school-stat">
                        <h2>{{ $guru->count() }}</h2>
                        <span>Guru & Staf</span>
                    </div>
                    <div class="col-6 col-lg-3 school-stat">
                        <h2>{{ $siswa->count() }}</h2>
                        <span>Siswa</span>
                    </div>
                    <div class="col-6 col-lg-3 school-stat">
                        <h2>{{ $ekstrakurikuler->count() }}</h2>
                        <span>Ekstrakurikuler</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-3 text-center">
                    @if ($profile && $profile->foto_kepsek)
                        <img src="{{ asset('storage/profil/' . $profile->foto_kepsek) }}"
                            alt="{{ $profile->kepala_sekolah }}" class="img-fluid rounded-4 shadow"
                            style="width:100%;height:420px;object-fit:cover;">
                    @else
                        <img src="{{ asset('assets/img/sekolah/FotoSekolah.png') }}" alt="Foto Sekolah"
                            class="img-fluid rounded-4 shadow" style="width:100%;height:420px;object-fit:cover;">
                    @endif
                </div>
                <div class="col-lg-9">
                    <span class="section-label">Komitmen Kami untuk Pendidikan</span>
                    <h2 class="text-primary fw-bold mt-2 mb-3">Sambutan Kepala Sekolah</h2>
                    <div class="section-line mb-4"></div>
                    <p class="fs-5 text-dark">
                        Puji syukur ke hadirat Tuhan YME atas segala rahmat dan karunia-Nya.
                        Selamat datang di website resmi {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}.
                    </p>
                    <p class="text-dark">
                        Website ini kami hadirkan sebagai sarana informasi dan komunikasi antara sekolah
                        dengan orang tua, peserta didik, serta masyarakat luas.
                    </p>
                    <p class="text-dark">
                        Melalui media ini, kami berharap informasi mengenai kegiatan, prestasi,
                        serta program pendidikan dapat tersampaikan secara transparan, cepat, dan akurat.
                    </p>
                    <hr class="my-4">
                    <h4 class="fw-bold mb-1">{{ $profile->kepala_sekolah ?? '-' }}</h4>
                    <p class="mb-0 text-muted">Kepala Sekolah</p>
                </div>
            </div>
        </div>
    </section>

    <section class="home-section bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
                <div>
                    <span class="section-label">Tenaga Pendidik Profesional</span>
                    <h2 class="text-primary fw-bold mt-2 mb-0">Guru & Staf Berkualitas</h2>
                    <div class="section-line"></div>
                </div>
                <a href="{{ route('public.guru') }}" class="btn btn-primary">Lihat Semua</a>
            </div>

            <p class="text-dark mt-4 mb-5" style="font-size:17px;line-height:1.7;">
                Guru dan staf kami terdiri dari tenaga profesional yang kompeten, berpengalaman,
                dan berdedikasi tinggi dalam memberikan layanan pendidikan berkualitas.
            </p>

            <div class="row g-4">
                @forelse($guru->take(4) as $dataGuru)
                    <div class="col-6 col-md-6 col-lg-3">
                        <a href="{{ route('public.guru.detail', $dataGuru->id_guru) }}" class="home-card-link">
                            <div class="card border-0 shadow-sm">
                                @if ($dataGuru->foto)
                                    <img src="{{ asset('storage/' . $dataGuru->foto) }}" alt="{{ $dataGuru->nama_guru }}"
                                        class="home-card-photo home-teacher-photo">
                                @else
                                    <div
                                        class="home-card-photo home-teacher-photo bg-white d-flex align-items-center justify-content-center">
                                        <span class="text-muted">Foto belum tersedia</span>
                                    </div>
                                @endif
                                <div class="text-center p-3">
                                    <h5 class="fw-bold text-dark mb-2">{{ $dataGuru->nama_guru }}</h5>
                                    <p class="text-dark mb-0">{{ $dataGuru->mapel ?? 'Guru' }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Data guru belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="home-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
                <div>
                    <span class="section-label">Informasi Sekolah</span>
                    <h2 class="text-primary fw-bold mt-2 mb-0">Berita Terbaru</h2>
                    <div class="section-line"></div>
                </div>
                <a href="{{ route('public.berita') }}" class="btn btn-primary">Lihat Semua</a>
            </div>

            <p class="text-dark mt-4 mb-5" style="font-size:17px;line-height:1.7;">
                Informasi dan berita terbaru seputar kegiatan {{ $profile->nama_sekolah ?? 'sekolah kami' }}.
            </p>

            <div class="row g-4">
                @forelse($beritas->take(3) as $berita)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('public.berita.detail', $berita->id_berita) }}" class="home-card-link">
                            <div class="card border-0 shadow-sm">
                                @if ($berita->gambar)
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                        class="home-card-photo home-news-photo">
                                @else
                                    <div
                                        class="home-card-photo home-news-photo bg-light d-flex align-items-center justify-content-center">
                                        <span class="text-muted">Gambar berita belum tersedia</span>
                                    </div>
                                @endif
                                <div class="card-body p-4">
                                    <small class="text-primary fw-semibold">
                                        {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') : '-' }}
                                    </small>
                                    <h5 class="home-card-title mt-2">{{ $berita->judul }}</h5>
                                    <p class="home-card-text mb-0">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi ?? ''), 100) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Berita belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="home-section bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
                <div>
                    <span class="section-label">Kegiatan Siswa</span>
                    <h2 class="text-primary fw-bold mt-2 mb-0">Ekstrakurikuler</h2>
                    <div class="section-line"></div>
                </div>
                <a href="{{ route('public.ekstrakurikuler') }}" class="btn btn-primary">Lihat Semua</a>
            </div>

            <p class="text-dark mt-4 mb-5" style="font-size:17px;line-height:1.7;">
                Berbagai kegiatan ekstrakurikuler untuk mengembangkan bakat, minat, kreativitas,
                dan potensi peserta didik {{ $profile->nama_sekolah ?? 'sekolah kami' }}.
            </p>

            <div class="row g-4">
                @forelse($ekstrakurikuler->take(3) as $eskul)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ \Illuminate\Support\Facades\Route::has('public.ekstrakurikuler.detail') ? route('public.ekstrakurikuler.detail', $eskul->id_eskul) : route('public.ekstrakurikuler') }}"
                            class="home-card-link">
                            <div class="card border-0 shadow-sm">
                                @if ($eskul->gambar)
                                    <img src="{{ asset('storage/' . $eskul->gambar) }}" alt="{{ $eskul->nama_eskul }}"
                                        class="home-card-photo home-eskul-photo">
                                @else
                                    <div
                                        class="home-card-photo home-eskul-photo bg-white d-flex align-items-center justify-content-center">
                                        <span class="text-muted">Gambar belum tersedia</span>
                                    </div>
                                @endif
                                <div class="card-body p-4">
                                    <h5 class="home-card-title mb-2">{{ $eskul->nama_eskul }}</h5>
                                    <p class="home-card-text mb-0">Pembina: {{ $eskul->pembina ?? '-' }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Data ekstrakurikuler belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="home-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
                <div>
                    <span class="section-label">Dokumentasi Sekolah</span>
                    <h2 class="text-primary fw-bold mt-2 mb-0">Galeri Sekolah</h2>
                    <div class="section-line"></div>
                </div>
                <a href="{{ route('public.galeri') }}" class="btn btn-primary">Lihat Semua</a>
            </div>

            <p class="text-dark mt-4 mb-5" style="font-size:17px;line-height:1.7;">
                Dokumentasi kegiatan dan berbagai momen sekolah {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}.
            </p>

            <div class="row g-4">
                @forelse($galeri->take(6) as $item)
                    @php
                        $extension = strtolower(pathinfo($item->file ?? '', PATHINFO_EXTENSION));
                        $isVideo =
                            ($item->kategori ?? '') == 'Video' || in_array($extension, ['mp4', 'webm', 'ogg', 'mov']);
                    @endphp
                    <div class="col-6 col-md-4">
                        <a href="{{ route('public.galeri.detail', $item->id_galeri) }}" class="home-card-link">
                            <div class="card border-0 shadow-sm">
                                @if ($isVideo)
                                    <div
                                        class="home-card-photo home-gallery-photo bg-dark d-flex align-items-center justify-content-center">
                                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                                            style="width:60px;height:60px;">
                                            <span class="text-primary">&#9654;</span>
                                        </div>
                                    </div>
                                @elseif($item->file)
                                    <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->judul }}"
                                        class="home-card-photo home-gallery-photo">
                                @else
                                    <div
                                        class="home-card-photo home-gallery-photo bg-light d-flex align-items-center justify-content-center">
                                        <span class="text-muted">Media belum tersedia</span>
                                    </div>
                                @endif
                                <div class="card-body p-3">
                                    <span class="badge {{ $isVideo ? 'bg-danger' : 'bg-success' }}">
                                        {{ $isVideo ? 'Video' : $item->kategori ?? 'Foto' }}
                                    </span>
                                    <h5 class="home-card-title mt-2 mb-1">{{ $item->judul }}</h5>
                                    <small class="text-muted">
                                        {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : '-' }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Dokumentasi galeri belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
