@extends('layouts.public')
@section('title', 'Detail Ekstrakurikuler')

@push('styles')
<style>
    .eskul-banner { background: linear-gradient(135deg, #194987, #0d47a1); padding: 45px 0; color: #fff; }
    .eskul-section { padding: 50px 0; background: #f5f6f8; }
    .eskul-label { color: #e59a00; font-size: 13px; font-weight: 700; letter-spacing: 1.5px; }
    .eskul-title { color: #194987; font-weight: 700; line-height: 1.4; }
    .eskul-detail-card { background: #fff; border: 1px solid #eee; border-radius: 12px; overflow: hidden; }
    .eskul-photo { width: 100%; max-height: 480px; object-fit: cover; display: block; }
    .eskul-content { padding: 30px; }
    .eskul-info { padding: 16px 0; border-bottom: 1px solid #e5e7eb; }
    .eskul-info:last-child { border-bottom: 0; }
    .eskul-info small { display: block; color: #777; margin-bottom: 5px; }
    .eskul-info p { color: #222; font-weight: 600; margin-bottom: 0; }
    .eskul-description { color: #555; line-height: 1.9; white-space: pre-line; }
    @media (max-width: 767px) {
        .eskul-section { padding: 30px 0; }
        .eskul-content { padding: 20px; }
        .eskul-photo { max-height: 320px; }
    }
</style>
@endpush

@section('content')

<section class="eskul-banner">
    <div class="container">
        <span class="eskul-label">KEGIATAN SISWA</span>
        <h1 class="fw-bold mt-2 mb-2">Detail Ekstrakurikuler</h1>
        <p class="mb-0">{{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}</p>
    </div>
</section>

<section class="eskul-section">
    <div class="container">
        <a href="{{ route('public.ekstrakurikuler') }}" class="btn btn-outline-primary mb-4">
            Kembali ke Ekstrakurikuler
        </a>

        <div class="eskul-detail-card shadow-sm">
            @if($ekstrakurikuler->gambar)
                <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" alt="{{ $ekstrakurikuler->nama_eskul }}" class="eskul-photo">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height:300px;">
                    Gambar ekstrakurikuler belum tersedia
                </div>
            @endif

            <div class="eskul-content">
                <span class="eskul-label">PROGRAM KEGIATAN SEKOLAH</span>
                <h2 class="eskul-title mt-2 mb-4">{{ $ekstrakurikuler->nama_eskul }}</h2>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="eskul-info">
                            <small>Pembina</small>
                            <p>{{ $ekstrakurikuler->pembina ?: 'Belum ditentukan' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="eskul-info">
                            <small>Jadwal Latihan</small>
                            <p>{{ $ekstrakurikuler->jadwal_latihan ?: 'Jadwal belum tersedia' }}</p>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3">Deskripsi Kegiatan</h5>
                <p class="eskul-description mb-0">{{ $ekstrakurikuler->deskripsi ?: 'Deskripsi kegiatan belum tersedia.' }}</p>

                <hr class="my-4">

                <a href="{{ route('public.ekstrakurikuler') }}" class="btn btn-primary px-4">
                    Kembali ke Daftar Ekstrakurikuler
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
