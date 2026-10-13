@extends('layouts.app')

@section('title', isset($berita) && $berita ? 'Edit Berita' : 'Tambah Berita')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">
                        {{ isset($berita) && $berita ? 'Edit Berita' : 'Tambah Berita' }}
                    </h4>

                    <a href="{{ route('admin.berita.index') }}"
                       class="btn btn-outline-secondary btn-sm ms-auto">
                        <i class="fas fa-arrow-left me-1"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <form
                action="{{ route('admin.berita.save', isset($berita) && $berita ? $berita->id_berita : null) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Periksa kembali isian berikut:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold">
                            Judul Berita <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="judul"
                            id="judul"
                            class="form-control @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $berita->judul ?? '') }}"
                            maxlength="50"
                            placeholder="Masukkan judul berita"
                            required
                        >

                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label fw-semibold">
                            Isi Berita <span class="text-danger">*</span>
                        </label>

                        <textarea
                            name="isi"
                            id="isi"
                            rows="8"
                            class="form-control @error('isi') is-invalid @enderror"
                            placeholder="Masukkan isi berita"
                            required>{{ old('isi', $berita->isi ?? '') }}</textarea>

                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-semibold">
                            Tanggal Publikasi <span class="text-danger">*</span>
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            id="tanggal"
                            class="form-control @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal', isset($berita) && $berita && $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('Y-m-d') : '') }}"
                            required
                        >

                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label fw-semibold">
                            Gambar Berita
                        </label>

                        <input
                            type="file"
                            name="gambar"
                            id="gambar"
                            class="form-control @error('gambar') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png"
                        >

                        <small class="text-muted">
                            Gambar bersifat opsional. Format JPG atau PNG, maksimal 2 MB.
                            Jika sedang mengedit, kosongkan jika ingin mempertahankan gambar lama.
                        </small>

                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (isset($berita) && $berita && $berita->gambar)
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Gambar Saat Ini</label>
                            <div>
                                <img
                                    src="{{ asset('storage/' . $berita->gambar) }}"
                                    alt="{{ $berita->judul }}"
                                    class="img-thumbnail"
                                    style="max-width: 300px; max-height: 220px; object-fit: contain;"
                                >
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.berita.index') }}"
                       class="btn btn-light">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        {{ isset($berita) && $berita ? 'Simpan Perubahan' : 'Simpan Berita' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
