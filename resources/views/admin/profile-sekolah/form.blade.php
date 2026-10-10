@extends('layouts.app')
@section('title', 'Edit Profil Sekolah')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card card-round shadow mb-4 border-0">
                <div class="card-header bg-warning text-dark">
                    <h4 class="card-title mb-0"><i class="bi bi-pencil-square me-1"></i> Form Edit Profil Sekolah</h4>
                </div>
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h6 class="fw-bold text-uppercase text-muted border-bottom pb-2 mb-3">Informasi Umum</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                <input type="text" id="nama_sekolah" name="nama_sekolah"
                                    class="form-control @error('nama_sekolah') is-invalid @enderror"
                                    value="{{ old('nama_sekolah', $profile->nama_sekolah ?? '') }}">
                                @error('nama_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kepala_sekolah" class="form-label">Kepala Sekolah</label>
                                <input type="text" id="kepala_sekolah" name="kepala_sekolah"
                                    class="form-control @error('kepala_sekolah') is-invalid @enderror"
                                    value="{{ old('kepala_sekolah', $profile->kepala_sekolah ?? '') }}">
                                @error('kepala_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="npsn" class="form-label">NPSN</label>
                                <input type="text" id="npsn" name="npsn"
                                    class="form-control @error('npsn') is-invalid @enderror"
                                    value="{{ old('npsn', $profile->npsn ?? '') }}">
                                @error('npsn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
                                <input type="number" id="tahun_berdiri" name="tahun_berdiri"
                                    class="form-control @error('tahun_berdiri') is-invalid @enderror"
                                    value="{{ old('tahun_berdiri', $profile->tahun_berdiri ?? '') }}">
                                @error('tahun_berdiri')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h6 class="fw-bold text-uppercase text-muted border-bottom pb-2 mb-3 mt-2">Kontak &amp; Alamat</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kontak" class="form-label">Kontak</label>
                                <input type="text" id="kontak" name="kontak"
                                    class="form-control @error('kontak') is-invalid @enderror"
                                    value="{{ old('kontak', $profile->kontak ?? '') }}">
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="alamat" class="form-label">Alamat Sekolah</label>
                                <textarea id="alamat" name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h6 class="fw-bold text-uppercase text-muted border-bottom pb-2 mb-3 mt-2">Visi, Misi &amp;
                            Deskripsi</h6>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="visi" class="form-label">Visi Sekolah</label>
                                <textarea id="visi" name="visi" rows="3" class="form-control @error('visi') is-invalid @enderror">{{ old('visi', $profile->visi ?? '') }}</textarea>
                                @error('visi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="misi" class="form-label">Misi Sekolah</label>
                                <textarea id="misi" name="misi" rows="5" class="form-control @error('misi') is-invalid @enderror">{{ old('misi', $profile->misi ?? '') }}</textarea>
                                @error('misi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Sekolah</label>
                                <textarea id="deskripsi" name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $profile->deskripsi ?? '') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h6 class="fw-bold text-uppercase text-muted border-bottom pb-2 mb-3 mt-2">Foto &amp; Logo Sekolah
                        </h6>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4">
                                <label for="foto" class="form-label">Foto Sekolah</label>
                                <input type="file" id="foto" name="foto"
                                    accept="image/jpeg,image/png,image/webp"
                                    class="form-control @error('foto') is-invalid @enderror">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!empty($profile->foto))
                                    <div class="mt-2">
                                        <small class="text-secondary d-block mb-1">Foto saat ini:</small>
                                        <img src="{{ asset('storage/profil/' . $profile->foto) }}" alt="Foto Sekolah"
                                            class="rounded shadow-sm"
                                            style="width:100%;max-width:200px;height:130px;object-fit:cover;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <label for="foto_kepsek" class="form-label">Foto Kepala Sekolah</label>
                                <input type="file" id="foto_kepsek" name="foto_kepsek"
                                    accept="image/jpeg,image/png,image/webp"
                                    class="form-control @error('foto_kepsek') is-invalid @enderror">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                                @error('foto_kepsek')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!empty($profile->foto_kepsek))
                                    <div class="mt-2">
                                        <small class="text-secondary d-block mb-1">Foto saat ini:</small>
                                        <img src="{{ asset('storage/profil/' . $profile->foto_kepsek) }}"
                                            alt="Foto Kepala Sekolah" class="rounded shadow-sm"
                                            style="width:100%;max-width:200px;height:220px;object-fit:cover;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <label for="logo" class="form-label">Logo Sekolah</label>
                                <input type="file" id="logo" name="logo"
                                    accept="image/jpeg,image/png,image/webp"
                                    class="form-control @error('logo') is-invalid @enderror">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah logo.</small>
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!empty($profile->logo))
                                    <div class="mt-2">
                                        <small class="text-secondary d-block mb-1">Logo saat ini:</small>
                                        <img src="{{ asset('storage/profil/' . $profile->logo) }}" alt="Logo Sekolah"
                                            class="rounded border bg-white p-1"
                                            style="width:110px;height:110px;object-fit:contain;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.profile') }}" class="btn btn-outline-secondary"><i
                                class="fa fa-arrow-left me-1"></i> Kembali</a>
                        <button type="submit" class="btn btn-dark"><i class="fa fa-save me-1"></i> Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
