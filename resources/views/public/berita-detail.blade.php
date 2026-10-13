@extends('layouts.public')

@section('title', $berita->judul)

@push('styles')
    <style>
        .detail-banner {
            background: linear-gradient(135deg, #194987, #0d47a1);
            padding: 40px 0;
            color: #fff;
        }

        .detail-section {
            padding: 50px 0;
            background: #f5f6f8;
            min-height: 500px;
        }

        .detail-label {
            color: #e59a00;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .detail-title {
            color: #194987;
            font-weight: 700;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .detail-image-wrapper {
            width: 100%;
            min-height: 200px;
            max-height: 520px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f6f8;
            border-radius: 12px;
            overflow: hidden;
        }

        .detail-image {
            display: block;
            max-width: 100%;
            max-height: 520px;
            width: auto;
            height: auto;
            object-fit: contain;
            object-position: center;
        }

        .detail-content {
            color: #444;
            font-size: 17px;
            line-height: 1.9;
            overflow-wrap: anywhere;
        }

        .detail-content img {
            max-width: 100%;
            height: auto;
        }

        .detail-date {
            color: #777;
            font-size: 14px;
        }

        .detail-article {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 30px;
        }

        .detail-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 25px;
        }

        .detail-footer .btn {
            border-radius: 7px;
            padding: 10px 20px;
        }

        @media (max-width: 767px) {
            .detail-banner {
                padding: 35px 0;
            }

            .detail-section {
                padding: 30px 0;
            }

            .detail-article {
                padding: 20px;
            }

            .detail-title {
                font-size: 26px;
            }

            .detail-content {
                font-size: 15px;
                line-height: 1.8;
            }

            .detail-image-wrapper {
                min-height: 150px;
                max-height: 380px;
            }

            .detail-image {
                max-height: 380px;
            }

            .detail-footer {
                align-items: stretch;
            }

            .detail-footer .btn {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')

    <section class="detail-banner">
        <div class="container">
            <span class="detail-label">INFORMASI SEKOLAH</span>
            <h1 class="fw-bold mt-2 mb-2">Detail Berita</h1>
            <p class="mb-0">
                {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}
            </p>
        </div>
    </section>

    <section class="detail-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <article class="detail-article shadow-sm">
                        <span class="detail-label">BERITA SEKOLAH</span>

                        <h2 class="detail-title mt-2 mb-3">
                            {{ $berita->judul }}
                        </h2>

                        <p class="detail-date mb-4">
                            <i class="far fa-calendar-alt me-2"></i>
                            {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') : 'Tanggal tidak tersedia' }}
                        </p>

                        @if ($berita->gambar)
                            <div class="detail-image-wrapper mb-4">
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                    class="detail-image">
                            </div>
                        @endif

                        <div class="detail-content">
                            {!! nl2br(e($berita->isi ?? 'Isi berita belum tersedia.')) !!}
                        </div>
                    </article>

                    <div class="detail-footer">
                        <a href="{{ route('public.berita') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Berita Lainnya
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
