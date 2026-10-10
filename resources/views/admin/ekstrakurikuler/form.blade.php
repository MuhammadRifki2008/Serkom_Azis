@extends('layouts.app')
@section('title', isset($ekstrakurikuler) ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler')
@section('content')

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow mb-4 border-0">
            <div class="card-header {{ isset($ekstrakurikuler) ? 'bg-warning text-dark' : 'bg-primary text-white' }}">
                <h3 class="card-title mb-0">
                    <i class="fa {{ isset($ekstrakurikuler) ? 'fa-pencil' : 'fa-plus' }} me-1"></i>
                    {{ isset($ekstrakurikuler) ? 'Form Edit Data Ekstrakurikuler' : 'Form Tambah Data Ekstrakurikuler' }}
                </h3>
            </div>

            <form action="{{ route('admin.ekstrakurikuler.save', isset($ekstrakurikuler) ? Crypt::encrypt($ekstrakurikuler->id_eskul) : null) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama_eskul" class="form-label fw-semibold">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
                        <input type="text" maxlength="40" class="form-control @error('nama_eskul') is-invalid @enderror" id="nama_eskul" name="nama_eskul" value="{{ old('nama_eskul', $ekstrakurikuler->nama_eskul ?? '') }}" placeholder="Contoh: Pramuka, Futsal, Paskibra" required>
                        @error('nama_eskul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pembina" class="form-label fw-semibold">Guru Pembina <span class="text-danger">*</span></label>
                        <input type="text" maxlength="40" class="form-control @error('pembina') is-invalid @enderror" id="pembina" name="pembina" value="{{ old('pembina', $ekstrakurikuler->pembina ?? '') }}" placeholder="Contoh: Bapak Ahmad, S.Pd." required>
                        @error('pembina')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jadwal_latihan" class="form-label fw-semibold">Jadwal Latihan / Pertemuan <span class="text-danger">*</span></label>
                        <input type="text" maxlength="40" class="form-control @error('jadwal_latihan') is-invalid @enderror" id="jadwal_latihan" name="jadwal_latihan" value="{{ old('jadwal_latihan', $ekstrakurikuler->jadwal_latihan ?? '') }}" placeholder="Contoh: Jumat, 15.00 - 17.00 WIB" required>
                        @error('jadwal_latihan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi Kegiatan</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" placeholder="Jelaskan tujuan dan aktivitas kegiatan ekskul ini...">{{ old('deskripsi', $ekstrakurikuler->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label fw-semibold">{{ isset($ekstrakurikuler) ? 'Ganti Gambar Kegiatan' : 'Foto / Gambar Kegiatan' }}</label>
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                        <small class="text-muted">Format: JPG, JPEG, PNG (Maks: 2MB). {{ isset($ekstrakurikuler) ? 'Biarkan kosong jika tidak diubah.' : '' }}</small>

                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if (isset($ekstrakurikuler) && $ekstrakurikuler->gambar && file_exists(public_path('storage/' . $ekstrakurikuler->gambar)))
                            <div class="mt-2">
                                <small class="text-secondary d-block">Gambar saat ini:</small>
                                <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" alt="{{ $ekstrakurikuler->nama_eskul }}" class="rounded shadow-sm mt-1" style="height: 80px; object-fit: cover;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn {{ isset($ekstrakurikuler) ? 'btn-warning' : 'btn-primary' }}">
                            <i class="bi bi-save me-1"></i>{{ isset($ekstrakurikuler) ? 'Simpan Perubahan' : 'Simpan Data Ekskul' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
