@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    .dashboard-welcome {
        border-radius: 12px;
    }

    .dashboard-stat {
        height: 100%;
        min-height: 105px;
    }

    .dashboard-stat .card-body {
        display: flex;
        align-items: center;
    }

    .dashboard-stat .col-icon {
        flex: 0 0 55px;
    }

    .dashboard-stat .icon-big {
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dashboard-stat .card-category {
        margin-bottom: 3px;
    }

    .dashboard-stat .card-title {
        margin-bottom: 0;
        font-size: 24px;
    }

    .dashboard-content {
        height: 100%;
    }

    .dashboard-content .card-body {
        height: calc(100% - 70px);
    }

    .school-logo {
        width: 78px;
        height: 78px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .school-item {
        min-height: 65px;
    }

    .school-item-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .news-item {
        min-height: 67px;
    }

    .news-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .news-title {
        line-height: 1.4;
    }
</style>
@endpush

@section('content')

@php
    $profile = \App\Models\ProfileSekolah::first();
@endphp

<div class="card card-round dashboard-welcome mb-4">
    <div class="card-body py-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/img/sekolah/logo.png') }}" class="school-logo me-3">
                    <div>
                        <p class="text-muted mb-1">Selamat Datang</p>
                        <h2 class="fw-bold mb-1"> SDN MOCH TOHA</h2>
                        <p class="text-muted mb-0">
                            Sistem Informasi SDN MOCH TOHA
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <span class="badge badge-primary p-2">
                    <i class="fas fa-calendar-alt me-1"></i>
                    {{ date('d F Y') }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-6 col-md-4 mb-4">
        <div class="card card-stats card-round dashboard-stat">
            <div class="card-body">
                <div class="col-icon">
                    <div class="icon-big icon-primary bubble-shadow-small">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                </div>

                <div class="col col-stats ms-3">
                    <p class="card-category">Guru</p>
                    <h4 class="card-title p-3">{{ $jumlahGuru }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4 mb-4">
        <div class="card card-stats card-round dashboard-stat">
            <div class="card-body">
                <div class="col-icon">
                    <div class="icon-big icon-info bubble-shadow-small">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>

                <div class="col col-stats ms-3">
                    <p class="card-category">Siswa</p>
                    <h4 class="card-title p-3">{{ $jumlahSiswa }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4 mb-4">
        <div class="card card-stats card-round dashboard-stat">
            <div class="card-body">
                <div class="col-icon">
                    <div class="icon-big icon-success bubble-shadow-small">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>

                <div class="col col-stats ms-3">
                    <p class="card-category">Berita</p>
                    <h4 class="card-title p-3">{{ $jumlahBerita }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4 mb-4">
        <div class="card card-stats card-round dashboard-stat">
            <div class="card-body">
                <div class="col-icon">
                    <div class="icon-big icon-secondary bubble-shadow-small">
                        <i class="fas fa-images"></i>
                    </div>
                </div>

                <div class="col col-stats ms-3">
                    <p class="card-category">Galeri</p>
                    <h4 class="card-title p-3">{{ $jumlahGaleri }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4 mb-4">
        <div class="card card-stats card-round dashboard-stat">
            <div class="card-body">
                <div class="col-icon">
                    <div class="icon-big icon-warning bubble-shadow-small">
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="col col-stats ms-3">
                    <p class="card-category">Ekstrakurikuler</p>
                    <h4 class="card-title p-3">{{ $jumlahEkstrakurikuler }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4 mb-4">
        <div class="card card-stats card-round dashboard-stat">
            <div class="card-body">
                <div class="col-icon">
                    <div class="icon-big icon-danger bubble-shadow-small">
                        <i class="fas fa-users"></i>
                    </div>
                </div>

                <div class="col col-stats ms-3">
                    <p class="card-category">User</p>
                    <h4 class="card-title p-3">{{ $jumlahUser }}</h4>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-7 mb-4">
        <div class="card card-round dashboard-content">

            <div class="card-header">
                <h4 class="card-title mb-0">
                    <i class="fas fa-school me-2"></i>
                    Profil Sekolah
                </h4>
            </div>

            <div class="card-body">

                @if ($profile)

                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('assets/img/sekolah/logo.png') }}" class="school-logo">

                        <div class="ms-3">
                            <h3 class="fw-bold mb-1">
                                {{ $profile->nama_sekolah }}
                            </h3>

                            <span class="badge badge-primary">
                                <i class="fas fa-school me-1"></i>
                                Sekolah Dasar
                            </span>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="school-item d-flex align-items-center">
                                <div class="school-item-icon icon-primary">
                                    <i class="fas fa-user-tie"></i>
                                </div>

                                <div class="ms-3">
                                    <small class="text-muted d-block">Kepala Sekolah</small>
                                    <strong>{{ $profile->kepala_sekolah }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="school-item d-flex align-items-center">
                                <div class="school-item-icon icon-info">
                                    <i class="fas fa-id-card"></i>
                                </div>

                                <div class="ms-3">
                                    <small class="text-muted d-block">NPSN</small>
                                    <strong>{{ $profile->npsn }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="school-item d-flex align-items-center">
                                <div class="school-item-icon icon-success">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>

                                <div class="ms-3">
                                    <small class="text-muted d-block">Tahun Berdiri</small>
                                    <strong>{{ $profile->tahun_berdiri }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="school-item d-flex align-items-center">
                                <div class="school-item-icon icon-warning">
                                    <i class="fas fa-phone"></i>
                                </div>

                                <div class="ms-3">
                                    <small class="text-muted d-block">Kontak</small>
                                    <strong>{{ $profile->kontak }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="border-top pt-3">
                                <small class="text-muted d-block mb-1">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    Alamat Sekolah
                                </small>

                                <strong>{{ $profile->alamat }}</strong>
                            </div>
                        </div>

                    </div>

                @else

                    <div class="text-center py-5">
                        <i class="fas fa-school fa-3x text-muted mb-3"></i>
                        <h5>Profil Sekolah Belum Tersedia</h5>
                        <p class="text-muted mb-0">
                            Silakan lengkapi data profil sekolah.
                        </p>
                    </div>

                @endif

            </div>
        </div>
    </div>

    <div class="col-lg-5 mb-4">
        <div class="card card-round dashboard-content">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-newspaper me-2"></i>
                        Berita Terbaru
                    </h4>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-primary btn-sm">
                        Lihat Semua
                    </a>
                </div>
            </div>

            <div class="card-body">

                @forelse ($beritaTerbaru as $berita)

                    <div class="news-item d-flex align-items-center border-bottom">

                        <div class="news-icon icon-success bubble-shadow-small">
                            <i class="fas fa-newspaper"></i>
                        </div>

                        <div class="ms-3 overflow-hidden">
                            <h6 class="fw-bold mb-1 text-truncate news-title">
                                {{ $berita->judul }}
                            </h6>

                            <small class="text-muted">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $berita->tanggal }}
                            </small>
                        </div>

                    </div>

                @empty

                    <div class="text-center py-5">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <h5>Belum Ada Berita</h5>
                        <p class="text-muted mb-0">
                            Berita sekolah akan tampil di sini.
                        </p>
                    </div>

                @endforelse

            </div>
        </div>
    </div>

</div>

@endsection
