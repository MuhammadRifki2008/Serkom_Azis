@extends('layouts.public')

@section('title', 'Galeri Sekolah')

@push('styles')
<style>
    .galeri-banner {
        background: linear-gradient(135deg, #194987, #0d47a1);
        padding: 55px 0;
        color: #fff;
    }

    .galeri-section {
        padding: 55px 0;
        background: #f5f6f8;
        min-height: 500px;
    }

    .galeri-label {
        color: #e59a00;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1.5px;
    }

    .galeri-heading {
        color: #194987;
        font-weight: 700;
    }

    .galeri-link {
        display: block;
        height: 100%;
        text-decoration: none;
        color: inherit;
    }

    .galeri-card {
        height: 100%;
        border: 1px solid #eee;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .galeri-link:hover .galeri-card {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, .10) !important;
    }

    .galeri-photo {
        width: 100%;
        height: 240px;
        object-fit: cover;
        display: block;
    }

    .galeri-video {
        height: 240px;
        background: #17202a;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .galeri-play {
        width: 62px;
        height: 62px;
        background: #fff;
        color: #194987;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
    }

    .galeri-title {
        color: #194987;
        font-size: 18px;
        font-weight: 700;
        line-height: 1.5;
    }

    .galeri-meta {
        font-size: 13px;
        color: #777;
    }

    .galeri-pagination {
        margin-top: 35px;
    }

    .galeri-pagination nav {
        display: flex;
        justify-content: center;
    }

    .galeri-pagination nav > div:first-child {
        display: none;
    }

    .galeri-pagination nav > div:last-child {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .galeri-pagination .pagination {
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-bottom: 0;
        flex-wrap: wrap;
    }

    .galeri-pagination .page-link {
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

    .galeri-pagination .page-link:hover {
        background: #eaf2ff;
        color: #0d47a1;
    }

    .galeri-pagination .page-item.active .page-link {
        background: #0756a5;
        border-color: #0756a5;
        color: #fff;
    }

    .galeri-pagination .page-item.disabled .page-link {
        color: #adb5bd;
        background: #fff;
    }

    @media (max-width: 767px) {
        .galeri-section {
            padding: 35px 0;
        }

        .galeri-banner {
            padding: 40px 0;
        }

        .galeri-photo,
        .galeri-video {
            height: 190px;
        }

        .galeri-title {
            font-size: 16px;
        }

        .galeri-pagination .pagination {
            gap: 5px;
        }

        .galeri-pagination .page-link {
            min-width: 38px;
            min-height: 38px;
            padding: 7px 10px;
        }
    }
</style>
@endpush

@section('content')

<section class="galeri-banner">
    <div class="container text-center">
        <span class="galeri-label text-warning">DOKUMENTASI SEKOLAH</span>
        <h1 class="fw-bold mt-2 mb-3">Galeri Sekolah</h1>
        <p class="mb-0">
            Dokumentasi kegiatan {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}.
        </p>
    </div>
</section>

<section class="galeri-section">
    <div class="container">
        <div class="mb-5">
            <span class="galeri-label">FOTO & VIDEO</span>
            <h2 class="galeri-heading mt-2 mb-2">Dokumentasi Kegiatan</h2>
            <p class="text-muted mb-0">
                Lihat berbagai kegiatan dan momen di lingkungan sekolah.
            </p>
        </div>

        <div class="row g-4">
            @forelse ($galeri as $item)
                @php
                    $extension = strtolower(pathinfo($item->file ?? '', PATHINFO_EXTENSION));
                    $isVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'mov']);
                @endphp

                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ route('public.galeri.detail', $item->id_galeri) }}"
                       class="galeri-link">

                        <article class="card galeri-card shadow-sm">
                            @if ($item->file && $isVideo)
                                <div class="galeri-video">
                                    <span class="galeri-play">
                                        <i class="fas fa-play"></i>
                                    </span>
                                </div>
                            @elseif ($item->file)
                                <img
                                    src="{{ asset('storage/' . $item->file) }}"
                                    alt="{{ $item->judul }}"
                                    class="galeri-photo"
                                    loading="lazy"
                                >
                            @else
                                <div class="galeri-video">
                                    <span class="text-white">Media belum tersedia</span>
                                </div>
                            @endif

                            <div class="card-body p-4">
                                <div class="mb-2">
                                    <span class="badge {{ $isVideo ? 'bg-danger' : 'bg-primary' }}">
                                        {{ $isVideo ? 'Video' : ($item->kategori ?: 'Foto') }}
                                    </span>
                                </div>

                                <h5 class="galeri-title mb-2">
                                    {{ $item->judul ?: 'Dokumentasi Sekolah' }}
                                </h5>

                                <p class="galeri-meta mb-0">
                                    {{ $item->tanggal
                                        ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y')
                                        : 'Tanggal belum tersedia' }}
                                </p>
                            </div>
                        </article>

                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center bg-white rounded-3 py-5">
                        <h5 class="fw-bold">Galeri Belum Tersedia</h5>
                        <p class="text-muted mb-0">
                            Dokumentasi sekolah belum ditambahkan.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($galeri->hasPages())
            <div class="galeri-pagination">
                {{ $galeri->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</section>

@endsection
