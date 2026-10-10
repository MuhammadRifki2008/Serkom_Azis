@extends('layouts.public')

@section('title', 'Ekstrakurikuler')

@push('styles')
    <style>
        .eskul-banner {
            background: linear-gradient(135deg, #194987, #0d47a1);
            padding: 55px 0;
            color: #fff;
        }

        .eskul-section {
            padding: 55px 0;
            background: #f5f6f8;
            min-height: 500px;
        }

        .eskul-label {
            color: #e59a00;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .eskul-heading {
            color: #194987;
            font-weight: 700;
        }

        .eskul-card-link {
            display: block;
            height: 100%;
            color: inherit;
            text-decoration: none;
        }

        .eskul-card {
            height: 100%;
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .eskul-card-link:hover .eskul-card {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .10);
        }

        .eskul-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
            display: block;
        }

        .eskul-placeholder {
            width: 100%;
            height: 240px;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }

        .eskul-title {
            color: #194987;
            font-size: 19px;
            font-weight: 700;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .eskul-info {
            color: #666;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 8px;
        }

        .eskul-info strong {
            color: #333;
        }

        .eskul-empty {
            padding: 60px 20px;
            text-align: center;
            background: #fff;
            border-radius: 12px;
        }

        .eskul-pagination {
            margin-top: 35px;
        }

        .eskul-pagination nav {
            display: flex;
            justify-content: center;
        }

        .eskul-pagination nav>div:first-child {
            display: none;
        }

        .eskul-pagination nav>div:last-child {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .eskul-pagination .pagination {
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-bottom: 0;
            flex-wrap: wrap;
        }

        .eskul-pagination .page-link {
            min-width: 44px;
            min-height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 9px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px !important;
            background: #fff;
            color: #194987;
            box-shadow: none;
        }

        .eskul-pagination .page-link:hover {
            background: #eaf2ff;
            color: #0d47a1;
        }

        .eskul-pagination .page-item.active .page-link {
            background: #0756a5;
            border-color: #0756a5;
            color: #fff;
        }

        .eskul-pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background: #fff;
        }

        @media (max-width: 767px) {
            .eskul-banner {
                padding: 40px 0;
            }

            .eskul-section {
                padding: 35px 0;
            }

            .eskul-image,
            .eskul-placeholder {
                height: 190px;
            }

            .eskul-title {
                font-size: 17px;
            }

            .eskul-pagination .pagination {
                gap: 5px;
            }

            .eskul-pagination .page-link {
                min-width: 38px;
                min-height: 38px;
                padding: 7px 10px;
            }
        }
    </style>
@endpush

@section('content')

    <section class="eskul-banner">
        <div class="container text-center">
            <span class="eskul-label text-warning">KEGIATAN SEKOLAH</span>
            <h1 class="fw-bold mt-2 mb-3">Ekstrakurikuler</h1>
            <p class="mb-0">
                Kenali kegiatan ekstrakurikuler
                {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}.
            </p>
        </div>
    </section>

    <section class="eskul-section">
        <div class="container">
            <div class="mb-5">
                <span class="eskul-label">PENGEMBANGAN BAKAT DAN MINAT</span>
                <h2 class="eskul-heading mt-2 mb-2">Kegiatan Ekstrakurikuler</h2>
                <p class="text-muted mb-0">
                    Temukan berbagai kegiatan untuk mengembangkan bakat,
                    minat, kreativitas, dan keterampilan peserta didik.
                </p>
            </div>

            <div class="row g-4">
                @forelse ($ekstrakurikuler as $eskul)
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('public.ekstrakurikuler.detail', $eskul->id_eskul) }}" class="eskul-card-link">

                            <article class="card eskul-card shadow-sm">
                                @if ($eskul->gambar)
                                    <img src="{{ asset('storage/' . $eskul->gambar) }}" alt="{{ $eskul->nama_eskul }}"
                                        class="eskul-image" loading="lazy">
                                @else
                                    <div class="eskul-placeholder">
                                        <i class="fas fa-image fa-3x"></i>
                                    </div>
                                @endif

                                <div class="card-body p-4">
                                    <h5 class="eskul-title">
                                        {{ $eskul->nama_eskul }}
                                    </h5>

                                    <p class="eskul-info">
                                        <strong>Pembina:</strong>
                                        {{ $eskul->pembina ?: 'Belum tersedia' }}
                                    </p>

                                    <p class="eskul-info mb-0">
                                        <strong>Jadwal:</strong>
                                        {{ $eskul->jadwal_latihan ?: 'Belum tersedia' }}
                                    </p>
                                </div>
                            </article>

                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="eskul-empty">
                            <i class="fas fa-info-circle fa-3x text-secondary mb-3"></i>
                            <h5 class="fw-bold text-dark">Belum Ada Ekstrakurikuler</h5>
                            <p class="text-muted mb-0">
                                Data ekstrakurikuler sekolah belum tersedia.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($ekstrakurikuler->hasPages())
                <div class="eskul-pagination">
                    {{ $ekstrakurikuler->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </section>

@endsection
