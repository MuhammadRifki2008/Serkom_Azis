@extends('layouts.public')
@section('title', $berita->judul)

@push('styles')
<style>
    .detail-banner { background: linear-gradient(135deg, #194987, #0d47a1); padding: 40px 0; color: #fff; }
    .detail-section { padding: 50px 0; }
    .detail-label { color: #e59a00; font-size: 13px; font-weight: 700; letter-spacing: 1.5px; }
    .detail-title { color: #194987; font-weight: 700; line-height: 1.4; }
    .detail-image { width: 100%; max-height: 480px; object-fit: cover; border-radius: 12px; }
    .detail-content { color: #444; font-size: 17px; line-height: 1.9; overflow-wrap: anywhere; }
    .detail-content img { max-width: 100%; height: auto; }
    .detail-date { color: #777; font-size: 14px; }
    .detail-article { background: #fff; border: 1px solid #eee; border-radius: 12px; padding: 30px; }
    @media (max-width: 767px) {
        .detail-section { padding: 30px 0; }
        .detail-article { padding: 20px; }
        .detail-title { font-size: 26px; }
    }
</style>
@endpush

@section('content')

<section class="detail-banner">
    <div class="container">
        <span class="detail-label">INFORMASI SEKOLAH</span>
        <h1 class="fw-bold mt-2 mb-2">Detail Berita</h1>
        <p class="mb-0">{{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}</p>
    </div>
</section>

<section class="detail-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <article class="detail-article shadow-sm">
                    <span class="detail-label">BERITA SEKOLAH</span>

                    <h2 class="detail-title mt-2 mb-3">
                        {{ $berita->judul }}
                    </h2>

                    <p class="detail-date mb-4">
                        {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') : 'Tanggal tidak tersedia' }}
                    </p>

                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}"
                             alt="{{ $berita->judul }}"
                             class="detail-image mb-4">
                    @endif

                    <div class="detail-content">
                        {!! nl2br(e($berita->isi ?? 'Isi berita belum tersedia.')) !!}
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <span class="text-muted small">
                            {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}
                        </span>

                        <a href="{{ route('public.berita') }}" class="btn btn-primary">
                            Berita Lainnya
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

@endsection
