@extends('layouts.public')
@section('title', 'Detail Galeri')

@push('styles')
<style>
    .galeri-banner { background: linear-gradient(135deg, #194987, #0d47a1); padding: 45px 0; color: white; }
    .galeri-section { padding: 50px 0; background: #f5f6f8; }
    .galeri-label { color: #e59a00; font-size: 13px; font-weight: 700; letter-spacing: 1.5px; }
    .galeri-title { color: #194987; font-weight: 700; line-height: 1.4; }
    .galeri-detail-card { background: white; border: 1px solid #eee; border-radius: 12px; overflow: hidden; }
    .galeri-media { display: block; width: 100%; max-height: 560px; object-fit: contain; background: #171717; }
    .galeri-content { padding: 30px; }
    .galeri-description { color: #555; line-height: 1.9; white-space: pre-line; }
    .galeri-meta { color: #777; font-size: 14px; }
    @media (max-width: 767px) {
        .galeri-section { padding: 30px 0; }
        .galeri-content { padding: 20px; }
        .galeri-media { max-height: 380px; }
        .galeri-title { font-size: 25px; }
    }
</style>
@endpush

@section('content')

<section class="galeri-banner">
    <div class="container text-center">
        <span class="galeri-label">DOKUMENTASI SEKOLAH</span>
        <h1 class="fw-bold mt-2 mb-2">Detail Galeri</h1>
        <p class="mb-0">{{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}</p>
    </div>
</section>

<section class="galeri-section">
    <div class="container">
        <a href="{{ route('public.galeri') }}" class="btn btn-outline-primary mb-4">
            Kembali ke Galeri
        </a>

        <div class="galeri-detail-card shadow-sm">
            @php
                $extension = strtolower(pathinfo($galeri->file ?? '', PATHINFO_EXTENSION));
                $isVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'mov']);
            @endphp

            @if($galeri->file && $isVideo)
                <video class="galeri-media" controls preload="metadata">
                    <source src="{{ asset('storage/' . $galeri->file) }}">
                    Browser kamu tidak mendukung pemutaran video.
                </video>
            @elseif($galeri->file)
                <img src="{{ asset('storage/' . $galeri->file) }}"
                     alt="{{ $galeri->judul }}"
                     class="galeri-media">
            @else
                <div class="d-flex align-items-center justify-content-center bg-light text-muted" style="height:300px;">
                    Media dokumentasi belum tersedia.
                </div>
            @endif

            <div class="galeri-content">
                <span class="galeri-label">DOKUMENTASI KEGIATAN</span>

                <h2 class="galeri-title mt-2 mb-3">
                    {{ $galeri->judul }}
                </h2>

                <div class="d-flex flex-wrap gap-3 mb-4 galeri-meta">
                    <span>
                        Kategori: <strong class="text-dark">{{ $galeri->kategori ?: '-' }}</strong>
                    </span>
                    <span>
                        Tanggal: <strong class="text-dark">{{ $galeri->tanggal ? \Carbon\Carbon::parse($galeri->tanggal)->format('d F Y') : '-' }}</strong>
                    </span>
                </div>

                <hr>

                <h5 class="fw-bold text-dark mb-3">Keterangan Dokumentasi</h5>
                <p class="galeri-description mb-0">
                    {{ $galeri->keterangan ?: 'Keterangan dokumentasi belum tersedia.' }}
                </p>

                <div class="border-top mt-4 pt-4">
                    <a href="{{ route('public.galeri') }}" class="btn btn-primary">
                        Kembali ke Galeri
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
