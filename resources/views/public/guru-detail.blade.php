@extends('layouts.public')

@section('title', 'Detail Guru')

@push('styles')
    <style>
        .detail-banner {
            background: linear-gradient(135deg, #194987, #0d47a1);
            padding: 45px 0;
            color: white;
        }

        .detail-section {
            padding: 55px 0;
            background: #f5f6f8;
            min-height: 600px;
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
        }

        .detail-photo {
            width: 100%;
            max-width: 380px;
            height: 500px;
            object-fit: contain;
            object-position: center;
            background: #f5f6f8;
            border-radius: 12px;
            display: block;
            margin: 0 auto;
        }

        .detail-photo-placeholder {
            width: 100%;
            max-width: 380px;
            height: 500px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            margin: 0 auto;
        }

        .detail-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 35px;
            min-height: 520px;
            display: flex;
            flex-direction: column;
        }

        .detail-info {
            padding: 20px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-info:last-child {
            border-bottom: none;
        }

        .detail-info small {
            display: block;
            margin-bottom: 7px;
            color: #777;
        }

        .detail-info p {
            color: #222;
            font-weight: 600;
            margin-bottom: 0;
            overflow-wrap: anywhere;
        }

        .detail-back {
            margin-top: 20px;
        }

        .detail-back .btn {
            border-radius: 7px;
            padding: 10px 20px;
        }

        @media (max-width: 991px) {
            .detail-section {
                padding: 35px 0;
            }

            .detail-photo,
            .detail-photo-placeholder {
                height: 450px;
            }

            .detail-card {
                padding: 28px;
                min-height: 500px;
            }
        }

        @media (max-width: 767px) {
            .detail-banner {
                padding: 35px 0;
            }

            .detail-photo,
            .detail-photo-placeholder {
                height: 420px;
                max-width: 320px;
            }

            .detail-card {
                padding: 22px;
                min-height: auto;
            }

            .detail-back .btn {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')

    <section class="detail-banner">
        <div class="container">
            <h1 class="fw-bold mb-2">Detail Guru</h1>
            <p class="mb-0">
                Informasi tenaga pendidik
                {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}
            </p>
        </div>
    </section>

    <section class="detail-section">
        <div class="container">
            <div class="row g-4 g-lg-5 align-items-start">

                <div class="col-lg-5">
                    @if ($guru->foto)
                        <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}"
                            class="detail-photo shadow-sm">
                    @else
                        <div class="detail-photo-placeholder shadow-sm">
                            <span>Foto guru belum tersedia</span>
                        </div>
                    @endif
                </div>

                <div class="col-lg-7">
                    <div class="detail-card">
                        <span class="detail-label">TENAGA PENDIDIK</span>

                        <h2 class="detail-title mt-2 mb-3">
                            {{ $guru->nama_guru }}
                        </h2>

                        <p class="text-muted mb-4">
                            Informasi mengenai tenaga pendidik di
                            {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}.
                        </p>

                        <div class="detail-info">
                            <small>Nama Lengkap</small>
                            <p>{{ $guru->nama_guru }}</p>
                        </div>

                        <div class="detail-info">
                            <small>NIP</small>
                            <p>{{ $guru->nip ?: 'Belum diisi' }}</p>
                        </div>

                        <div class="detail-info">
                            <small>Bidang Pengajaran</small>
                            <p>{{ $guru->mapel ?: 'Belum diisi' }}</p>
                        </div>
                    </div>

                    <div class="detail-back">
                        <a href="{{ route('public.guru') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali ke Guru & Staf
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
