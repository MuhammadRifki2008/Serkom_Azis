@extends('layouts.app')
@section('title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')
@section('content')

<div class="row justify-content-center">
    <div class="col-10">
        <div class="card shadow mb-4 border-0 ">
            <div class="card-header {{ isset($berita) ? 'bg-warning text-dark' : 'bg-primary text-white' }}">
                <h3 class="card-title mb-0">
                    <i class="bi {{ isset($berita) ? 'bi-pencil-square' : 'bi-plus-lg' }} me-1"></i>
                    {{ isset($berita) ? 'Form Edit Berita' : 'Form Tulis Berita Baru' }}
                </h3>
            </div>

            <form action="{{ route('admin.berita.save', isset($berita) ? Crypt::encrypt($berita->id) : null) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" placeholder="Maksimal 50 karakter" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label fw-semibold">Tanggal Berita <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', isset($berita) ? $berita->tanggal : date('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gambar" class="form-label fw-semibold">{{ isset($berita) ? 'Ganti Foto Sampul / Gambar' : 'Foto Sampul / Gambar' }}</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG (Maks: 2MB). {{ isset($berita) ? 'Biarkan kosong jika tidak diubah.' : '' }}</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if (isset($berita) && $berita->gambar && file_exists(public_path('storage/' . $berita->gambar)))
                                <div class="mt-2">
                                    <small class="text-secondary d-block">Gambar saat ini:</small>
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="rounded shadow-sm mt-1" style="height: 80px; object-fit: cover;">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label fw-semibold">Isi Berita Lengkap <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="8" placeholder="Tuliskan berita secara lengkap di sini..." required>{{ old('isi', $berita->isi ?? '') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn {{ isset($berita) ? 'btn-warning' : 'btn-primary' }}">
                            <i class="bi bi-save me-1"></i> {{ isset($berita) ? 'Simpan Perubahan' : 'Publikasikan Berita' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
