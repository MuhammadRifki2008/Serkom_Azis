@extends('layouts.public')
@section('title', 'Profil Sekolah')

@push('styles')
    <style>
        .profile-banner {
            background: linear-gradient(135deg, #194987, #0d47a1);
            padding: 55px 0;
            color: #fff;
        }

        .profile-section {
            padding: 55px 0;
        }

        .profile-label {
            color: #d99500;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .profile-title {
            color: #194987;
            font-weight: 700;
        }

        .school-photo {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 10px;
        }

        .school-logo {
            width: 65px;
            height: 65px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .school-description {
            color: #555;
            line-height: 1.8;
            white-space: pre-line;
        }

        .profile-information {
            border-top: 1px solid #e5e7eb;
        }

        .profile-information>div {
            padding: 14px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .profile-information>div:last-child {
            border-bottom: 0;
        }

        .info-label {
            color: #777;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .info-value {
            color: #222;
            font-weight: 500;
            margin-bottom: 0;
            overflow-wrap: anywhere;
        }

        .principal-photo {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 10px;
        }

        .principal-message {
            color: #555;
            line-height: 1.9;
        }

        .principal-name {
            border-left: 4px solid #d99500;
            padding-left: 16px;
            margin-top: 25px;
        }

        .vision-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 28px;
            height: 100%;
        }

        .vision-card p {
            color: #555;
            line-height: 1.9;
            white-space: pre-line;
            margin-bottom: 0;
        }

        .section-line {
            width: 65px;
            height: 4px;
            background: #d99500;
            border-radius: 5px;
            margin: 14px 0 22px;
        }

        @media (max-width: 767px) {
            .profile-section {
                padding: 35px 0;
            }

            .profile-banner {
                padding: 40px 0;
            }

            .school-photo {
                height: 250px;
            }

            .principal-photo {
                height: 320px;
            }

            .vision-card {
                padding: 22px;
            }
        }
    </style>
@endpush

@section('content')

    <section class="profile-banner">
        <div class="container text-center">
            <span class="profile-label">MENGENAL SEKOLAH KAMI</span>
            <h1 class="fw-bold mt-2 mb-3">Profil Sekolah</h1>
            <p class="mb-0">{{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}</p>
        </div>
    </section>

    <section class="profile-section">
        <div class="container">
            <div class="row g-4 g-lg-5 align-items-center">
                <div class="col-lg-5">
                    @if ($profile && $profile->foto)
                        <img src="{{ asset('storage/profil/' . $profile->foto) }}" alt="Foto {{ $profile->nama_sekolah }}"
                            class="school-photo">
                    @else
                        <img src="{{ asset('assets/img/sekolah/FotoSekolah.png') }}" alt="Foto Sekolah"
                            class="school-photo">
                    @endif
                </div>

                <div class="col-lg-7">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        @if ($profile && $profile->logo)
                            <img src="{{ asset('storage/profil/' . $profile->logo) }}" alt="Logo Sekolah"
                                class="school-logo">
                        @else
                            <img src="{{ asset('assets/img/sekolah/logo.png') }}" alt="Logo Sekolah" class="school-logo">
                        @endif
                        <div>
                            <span class="profile-label">IDENTITAS SEKOLAH</span>
                            <h2 class="profile-title mt-1 mb-0">{{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}</h2>
                        </div>
                    </div>

                    <p class="school-description mb-4">{{ $profile->deskripsi ?: 'Deskripsi sekolah belum tersedia.' }}</p>

                    <div class="profile-information">
                        <div>
                            <p class="info-label">Nama Sekolah</p>
                            <p class="info-value">{{ $profile->nama_sekolah ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="info-label">NPSN</p>
                            <p class="info-value">{{ $profile->npsn ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="info-label">Tahun Berdiri</p>
                            <p class="info-value">{{ $profile->tahun_berdiri ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="info-label">Kontak</p>
                            <p class="info-value">{{ $profile->kontak ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="info-label">Alamat</p>
                            <p class="info-value">{{ $profile->alamat ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="profile-section bg-light">
        <div class="container">
            <div class="row g-4 g-lg-5 align-items-center">
                <div class="col-md-5 col-lg-4">
                    @if ($profile && $profile->foto_kepsek)
                        <img src="{{ asset('storage/profil/' . $profile->foto_kepsek) }}"
                            alt="{{ $profile->kepala_sekolah }}" class="principal-photo">
                    @else
                        <div class="bg-white rounded d-flex align-items-center justify-content-center text-muted"
                            style="height:350px;">
                            Foto kepala sekolah belum tersedia
                        </div>
                    @endif
                </div>

                <div class="col-md-7 col-lg-8">
                    <span class="profile-label">SAMBUTAN SEKOLAH</span>
                    <h2 class="profile-title mt-2 mb-0">Kepala Sekolah</h2>
                    <div class="section-line"></div>

                    <p class="principal-message">
                        Selamat datang di website resmi {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}.
                        Website ini menjadi sarana informasi dan komunikasi antara sekolah,
                        peserta didik, orang tua, serta masyarakat.
                    </p>
                    <p class="principal-message mb-0">
                        Kami berharap website ini membantu masyarakat mengenal profil sekolah,
                        memperoleh informasi kegiatan, dan mengikuti perkembangan pendidikan
                        di lingkungan sekolah.
                    </p>

                    <div class="principal-name">
                        <h5 class="fw-bold text-dark mb-1">{{ $profile->kepala_sekolah ?: '-' }}</h5>
                        <p class="text-muted mb-0">Kepala Sekolah {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="profile-section">
        <div class="container">
            <div class="text-center mb-5">
                <span class="profile-label">ARAH DAN TUJUAN PENDIDIKAN</span>
                <h2 class="profile-title mt-2 mb-2">Visi &amp; Misi Sekolah</h2>
                <p class="text-muted mb-0">Landasan pendidikan {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="vision-card">
                        <span class="profile-label">01 — VISI</span>
                        <h3 class="profile-title mt-2 mb-3">Visi Sekolah</h3>
                        <div class="section-line"></div>
                        <p>{{ $profile->visi ?: 'Visi sekolah belum tersedia.' }}</p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="vision-card">
                        <span class="profile-label">02 — MISI</span>
                        <h3 class="profile-title mt-2 mb-3">Misi Sekolah</h3>
                        <div class="section-line"></div>
                        <p>{{ $profile->misi ?: 'Misi sekolah belum tersedia.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
