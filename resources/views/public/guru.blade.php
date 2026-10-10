@extends('layouts.public')

@section('title', 'Guru & Staf')

@push('styles')
    <style>
        .guru-banner {
            background: linear-gradient(135deg, #194987, #0d47a1);
            padding: 55px 0;
            color: #fff;
        }

        .guru-section {
            padding: 55px 0;
            background: #f5f6f8;
            min-height: 500px;
        }

        .guru-label {
            color: #e59a00;
            letter-spacing: 2px;
            font-size: 14px;
            font-weight: 600;
        }

        .guru-heading {
            color: #194987;
            font-weight: 700;
        }

        .guru-card-link {
            display: block;
            height: 100%;
            color: inherit;
            text-decoration: none;
        }

        .guru-card {
            height: 100%;
            border: 0;
            border-radius: 15px;
            overflow: hidden;
            background: #fff;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .guru-card-link:hover .guru-card {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .12) !important;
        }

        .guru-photo {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }

        .guru-info {
            padding: 20px 15px;
            text-align: center;
        }

        .guru-info h5 {
            font-weight: 700;
            color: #194987;
            margin-bottom: 8px;
        }

        .guru-info p {
            color: #777;
            margin-bottom: 0;
        }

        .guru-empty {
            background: #fff;
            padding: 50px 20px;
            border-radius: 12px;
            text-align: center;
        }

        .guru-pagination {
            margin-top: 35px;
        }

        .guru-pagination nav {
            display: flex;
            justify-content: center;
        }

        .guru-pagination nav>div:first-child {
            display: none;
        }

        .guru-pagination nav>div:last-child {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .guru-pagination .pagination {
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-bottom: 0;
            flex-wrap: wrap;
        }

        .guru-pagination .page-link {
            min-width: 44px;
            min-height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px !important;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #194987;
            padding: 9px 14px;
            box-shadow: none;
        }

        .guru-pagination .page-link:hover {
            background: #eaf2ff;
            color: #0d47a1;
        }

        .guru-pagination .page-item.active .page-link {
            background: #0756a5;
            border-color: #0756a5;
            color: #fff;
        }

        .guru-pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background: #fff;
        }

        @media (max-width: 767px) {
            .guru-banner {
                padding: 40px 0;
            }

            .guru-section {
                padding: 35px 0;
            }

            .guru-photo {
                height: 220px;
            }

            .guru-info {
                padding: 16px 10px;
            }

            .guru-info h5 {
                font-size: 16px;
            }

            .guru-info p {
                font-size: 13px;
            }

            .guru-pagination .pagination {
                gap: 5px;
            }

            .guru-pagination .page-link {
                min-width: 38px;
                min-height: 38px;
                padding: 7px 10px;
            }
        }
    </style>
@endpush

@section('content')

    <section class="guru-banner">
        <div class="container text-center">
            <span class="guru-label text-warning">TENAGA PENDIDIK</span>
            <h1 class="fw-bold mt-2 mb-3">Guru & Staf</h1>
            <p class="mb-0">
                Kenali tenaga pendidik {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}.
            </p>
        </div>
    </section>

    <section class="guru-section">
        <div class="container">
            <div class="mb-5">
                <span class="guru-label">TENAGA PENDIDIK PROFESIONAL</span>
                <h2 class="guru-heading mt-2 mb-3">Guru & Staf Berkualitas</h2>
                <p class="text-muted mb-0">
                    Kenali tenaga pendidik yang berdedikasi dalam memberikan
                    pendidikan terbaik bagi peserta didik.
                </p>
            </div>

            <div class="row g-4">
                @forelse ($guru as $dataGuru)
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ route('public.guru.detail', $dataGuru->id_guru) }}" class="guru-card-link">

                            <div class="card guru-card shadow-sm">
                                @if ($dataGuru->foto)
                                    <img src="{{ asset('storage/' . $dataGuru->foto) }}" alt="{{ $dataGuru->nama_guru }}"
                                        class="guru-photo">
                                @else
                                    <div class="guru-photo bg-light d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user-tie fa-5x text-secondary"></i>
                                    </div>
                                @endif

                                <div class="guru-info">
                                    <h5>{{ $dataGuru->nama_guru }}</h5>
                                    <p>{{ $dataGuru->mapel ?: 'Guru' }}</p>
                                </div>
                            </div>

                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="guru-empty">
                            <h5 class="fw-bold mb-2">Data Guru Belum Tersedia</h5>
                            <p class="text-muted mb-0">
                                Data guru akan ditampilkan di halaman ini.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($guru->hasPages())
                <div class="guru-pagination">
                    {{ $guru->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </section>

@endsection
