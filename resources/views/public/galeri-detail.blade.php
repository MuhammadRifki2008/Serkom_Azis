@extends('layouts.public')

@section('title', 'Detail Galeri')

@push('styles')
    <style>
        .galeri-banner {
            background: linear-gradient(135deg, #194987, #0d47a1);
            padding: 40px 0;
            color: #fff;
        }

        .galeri-section {
            padding: 50px 0;
            background: #f5f6f8;
            min-height: 500px;
        }

        .galeri-label {
            color: #e59a00;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .galeri-title {
            color: #194987;
            font-weight: 700;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .galeri-detail-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 30px;
        }

        .galeri-media-wrapper {
            width: 100%;
            min-height: 200px;
            max-height: 520px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #171717;
            border-radius: 12px;
            overflow: hidden;
        }

        .galeri-media {
            display: block;
            max-width: 100%;
            max-height: 520px;
            width: auto;
            height: auto;
            object-fit: contain;
            object-position: center;
        }

        video.galeri-media {
            width: 100%;
        }

        .galeri-description {
            color: #555;
            font-size: 16px;
            line-height: 1.9;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .galeri-meta {
            color: #777;
            font-size: 14px;
        }

        .galeri-footer {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 25px;
        }

        .galeri-footer .btn {
            border-radius: 7px;
            padding: 10px 20px;
        }

        @media (max-width: 767px) {
            .galeri-banner {
                padding: 35px 0;
            }

            .galeri-section {
                padding: 30px 0;
            }

            .galeri-detail-card {
                padding: 20px;
            }

            .galeri-title {
                font-size: 26px;
            }

            .galeri-media-wrapper {
                min-height: 150px;
                max-height: 380px;
            }

            .galeri-media {
                max-height: 380px;
            }

            .galeri-footer .btn {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')

    <section class="galeri-banner">
        <div class="container">
            <span class="galeri-label">DOKUMENTASI SEKOLAH</span>
            <h1 class="fw-bold mt-2 mb-2">Detail Galeri</h1>
            <p class="mb-0">
                {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}
            </p>
        </div>
    </section>

    <section class="galeri-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    @php
                        $extension = strtolower(pathinfo($galeri->file ?? '', PATHINFO_EXTENSION));
                        $isVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'mov']);
                    @endphp

                    <article class="galeri-detail-card shadow-sm">
                        <span class="galeri-label">DOKUMENTASI KEGIATAN</span>

                        <h2 class="galeri-title mt-2 mb-3">
                            {{ $galeri->judul ?: 'Dokumentasi Sekolah' }}
                        </h2>

                        <div class="d-flex flex-wrap gap-3 mb-4 galeri-meta">
                            <span>
                                Kategori:
                                <strong class="text-dark">
                                    {{ $galeri->kategori ?: '-' }}
                                </strong>
                            </span>

                            <span>
                                Tanggal:
                                <strong class="text-dark">
                                    {{ $galeri->tanggal ? \Carbon\Carbon::parse($galeri->tanggal)->format('d F Y') : 'Tanggal tidak tersedia' }}
                                </strong>
                            </span>
                        </div>

                        @if ($galeri->file)
                            <div class="galeri-media-wrapper mb-4">
                                @if ($isVideo)
                                    <video class="galeri-media" controls preload="metadata">
                                        <source src="{{ asset('storage/' . $galeri->file) }}">
                                        Browser kamu tidak mendukung pemutaran video.
                                    </video>
                                @else
                                    <img src="{{ asset('storage/' . $galeri->file) }}"
                                        alt="{{ $galeri->judul ?: 'Dokumentasi Sekolah' }}" class="galeri-media">
                                @endif
                            </div>
                        @else
                            <div class="galeri-media-wrapper mb-4 text-white">
                                <span>Media dokumentasi belum tersedia.</span>
                            </div>
                        @endif

                        <hr class="my-4">

                        <h5 class="fw-bold text-dark mb-3">
                            Keterangan Dokumentasi
                        </h5>

                        <div class="galeri-description">
                            {{ $galeri->keterangan ?: 'Keterangan dokumentasi belum tersedia.' }}</div>
                    </article>

                    <div class="galeri-footer">
                        <a href="{{ route('public.galeri') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali ke Galeri
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
