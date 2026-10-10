@extends('layouts.app')
@section('title', 'Profil Sekolah')
@section('content')
    <div class="page-header">
        <h4 class="page-title text-dark">Profil Sekolah</h4>
    </div>

    <div class="card card-round shadow-sm border-0">
        <div class="card-header">
            <div class="card-head-row">
                <h4 class="card-title text-dark">Informasi Profil Sekolah</h4>
                <div class="card-tools">
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-warning btn-round btn-sm text-dark">Edit
                        Profil</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if ($profile)
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="border rounded-3 p-3 mb-3 text-center">
                            <h6 class="text-dark fw-bold border-bottom pb-2 mb-3">Logo Sekolah</h6>
                            @if ($profile->logo)
                                <img src="{{ asset('storage/profil/' . $profile->logo) }}" alt="Logo Sekolah"
                                    class="border rounded bg-white p-2"
                                    style="width:120px;height:120px;object-fit:contain;">
                            @else
                                <div class="bg-light border rounded d-flex align-items-center justify-content-center mx-auto text-dark"
                                    style="width:120px;height:120px;">Logo belum tersedia</div>
                            @endif
                        </div>

                        <div class="border rounded-3 p-3 mb-3">
                            <h6 class="text-dark fw-bold border-bottom pb-2 mb-3">Foto Kepala Sekolah</h6>
                            @if ($profile->foto_kepsek)
                                <img src="{{ asset('storage/profil/' . $profile->foto_kepsek) }}"
                                    alt="{{ $profile->kepala_sekolah }}" class="w-100 rounded shadow-sm"
                                    style="height:260px;object-fit:cover;">
                            @else
                                <div class="bg-light border rounded d-flex align-items-center justify-content-center text-dark text-center"
                                    style="height:220px;">Foto kepala sekolah belum tersedia</div>
                            @endif
                        </div>

                        <div class="border rounded-3 p-3">
                            <h6 class="text-dark fw-bold border-bottom pb-2 mb-3">Foto Sekolah</h6>
                            @if ($profile->foto)
                                <img src="{{ asset('storage/profil/' . $profile->foto) }}" alt="Foto Sekolah"
                                    class="w-100 rounded shadow-sm" style="height:200px;object-fit:cover;">
                            @else
                                <div class="bg-light border rounded d-flex align-items-center justify-content-center text-dark text-center"
                                    style="height:200px;">Foto sekolah belum tersedia</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <h5 class="fw-bold text-dark mb-3">Identitas Sekolah</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Nama Sekolah</h6>
                                    <p class="text-dark mb-0">{{ $profile->nama_sekolah ?: '-' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Kepala Sekolah</h6>
                                    <p class="text-dark mb-0">{{ $profile->kepala_sekolah ?: '-' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">NPSN</h6>
                                    <p class="text-dark mb-0">{{ $profile->npsn ?: '-' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Tahun Berdiri</h6>
                                    <p class="text-dark mb-0">{{ $profile->tahun_berdiri ?: '-' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Kontak</h6>
                                    <p class="text-dark mb-0">{{ $profile->kontak ?: '-' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Alamat</h6>
                                    <p class="text-dark mb-0" style="white-space:pre-line;">{{ $profile->alamat ?: '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="border rounded-3 p-3 mb-3">
                            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Visi Sekolah</h6>
                            <p class="text-dark mb-0" style="white-space:pre-line;line-height:1.8;">
                                {{ $profile->visi ?: 'Visi sekolah belum diisi.' }}</p>
                        </div>

                        <div class="border rounded-3 p-3 mb-3">
                            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Misi Sekolah</h6>
                            <p class="text-dark mb-0" style="white-space:pre-line;line-height:1.8;">
                                {{ $profile->misi ?: 'Misi sekolah belum diisi.' }}</p>
                        </div>

                        <div class="border rounded-3 p-3">
                            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Deskripsi Sekolah</h6>
                            <p class="text-dark mb-0" style="white-space:pre-line;line-height:1.8;">
                                {{ $profile->deskripsi ?: 'Deskripsi sekolah belum diisi.' }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning text-dark">Data profil sekolah belum tersedia.</div>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Isi Profil Sekolah</a>
            @endif
        </div>
    </div>
@endsection
