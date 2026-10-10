@extends('layouts.public')

@section('title', 'Berita Sekolah')

@push('styles')
    <style>
        .berita-banner {
            background: linear-gradient(135deg, #194987, #0d47a1);
            padding: 55px 0;
            color: #fff;
        }

        .berita-section {
            padding: 55px 0;
            background: #f5f6f8;
            min-height: 500px;
        }

        .berita-label {
            color: #e59a00;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .berita-heading {
            color: #194987;
            font-weight: 700;
        }

        .berita-card-link {
            display: block;
            height: 100%;
            text-decoration: none;
            color: inherit;
        }

        .berita-card {
            height: 100%;
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .berita-card-link:hover .berita-card {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .10);
        }

        .berita-photo {
            width: 100%;
            height: 230px;
            object-fit: cover;
            display: block;
        }

        .berita-date {
            color: #194987;
            font-size: 13px;
        }

        .berita-title {
            color: #194987;
            font-size: 19px;
            font-weight: 700;
            line-height: 1.5;
        }

        .berita-description {
            color: #666;
            font-size: 14px;
            line-height: 1.7;
        }

        .berita-empty {
            padding: 60px 20px;
            text-align: center;
            background: #fff;
            border-radius: 12px;
        }

        .berita-pagination {
            margin-top: 35px;
        }

        .berita-pagination nav {
            display: flex;
            justify-content: center;
        }

        .berita-pagination nav>div:first-child {
            display: none;
        }

        .berita-pagination nav>div:last-child {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .berita-pagination .pagination {
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-bottom: 0;
            flex-wrap: wrap;
        }

        .berita-pagination .page-link {
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

        .berita-pagination .page-link:hover {
            background: #eaf2ff;
            color: #0d47a1;
        }

        .berita-pagination .page-item.active .page-link {
            background: #0756a5;
            border-color: #0756a5;
            color: #fff;
        }

        .berita-pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background: #fff;
        }

        .berita-back {
            margin-top: 35px;
        }

        @media (max-width: 767px) {
            .berita-section {
                padding: 35px 0;
            }

            .berita-banner {
                padding: 40px 0;
            }

            .berita-photo {
                height: 190px;
            }

            .berita-title {
                font-size: 17px;
            }

            .berita-pagination .pagination {
                gap: 5px;
            }

            .berita-pagination .page-link {
                min-width: 38px;
                min-height: 38px;
                padding: 7px 10px;
            }
        }
    </style>
@endpush

@section('content')

    <section class="berita-banner">
        <div class="container text-center">
            <span class="berita-label">INFORMASI SEKOLAH</span>
            <h1 class="fw-bold mt-2 mb-3">Berita Sekolah</h1>
            <p class="mb-0">
                Informasi dan kegiatan terbaru
                {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}.
            </p>
        </div>
    </section>

    <section class="berita-section">
        <div class="container">
            <div class="mb-5">
                <span class="berita-label">INFORMASI TERKINI</span>
                <h2 class="berita-heading mt-2 mb-2">Berita Terbaru</h2>
                <p class="text-muted mb-0">
                    Temukan informasi, kegiatan, dan kabar terbaru dari sekolah kami.
                </p>
            </div>

            <div class="row g-4">
                @forelse ($berita as $itemBerita)
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('public.berita.detail', $itemBerita->id_berita) }}" class="berita-card-link">

                            <article class="card berita-card shadow-sm">
                                @if ($itemBerita->gambar)
                                    <img src="{{ asset('storage/' . $itemBerita->gambar) }}" alt="{{ $itemBerita->judul }}"
                                        class="berita-photo">
                                @else
                                    <div class="berita-photo bg-light d-flex align-items-center justify-content-center">
                                        <span class="text-muted">
                                            Gambar berita belum tersedia
                                        </span>
                                    </div>
                                @endif

                                <div class="card-body p-4">
                                    <span class="berita-date">
                                        {{ $itemBerita->tanggal
                                            ? \Carbon\Carbon::parse($itemBerita->tanggal)->format('d M Y')
                                            : 'Tanggal belum tersedia' }}
                                    </span>

                                    <h5 class="berita-title mt-2 mb-3">
                                        {{ $itemBerita->judul }}
                                    </h5>

                                    <p class="berita-description mb-0">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($itemBerita->isi ?? ''), 130) }}
                                    </p>
                                </div>
                            </article>

                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="berita-empty">
                            <h5 class="fw-bold text-dark">Belum Ada Berita</h5>
                            <p class="text-muted mb-0">
                                Berita sekolah belum tersedia saat ini.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($berita->hasPages())
                <div class="berita-pagination">
                    {{ $berita->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </section>

@endsection
