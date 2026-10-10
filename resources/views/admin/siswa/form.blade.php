 @extends('layouts.app')

@section('title', isset($siswa) ? 'Edit Siswa' : 'Tambah Siswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow mb-4 border-0">

            <div class="card-header {{ isset($siswa) ? 'bg-warning text-dark' : 'bg-primary text-white' }}">
                <h3 class="card-title mb-0">
                    <i class="bi {{ isset($siswa) ? 'bi-pencil-square' : 'bi-plus-lg' }} me-1"></i>
                    {{ isset($siswa) ? 'Form Edit Data Siswa' : 'Form Tambah Data Siswa Baru' }}
                </h3>
            </div>

            <form action="{{ route('admin.siswa.save', isset($siswa) ? Crypt::encrypt($siswa->id_siswa) : null) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN (10 Digit Angka) <span class="text-danger">*</span></label>
                        <input type="text" maxlength="10" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn ?? '') }}" placeholder="Contoh: 0071234567" required>
                        @error('nisn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_siswa" class="form-label">Nama Lengkap Siswa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa ?? '') }}" placeholder="Contoh: Muhammad Farhan" required>
                        @error('nama_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" id="jk_l" value="Laki-Laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? 'Laki-Laki') == 'Laki-Laki' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jk_l">Laki-Laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" id="jk_p" value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'Perempuan' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jk_p">Perempuan</label>
                            </div>
                        </div>
                        @error('jenis_kelamin')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tahun_masuk" class="form-label">Tahun Masuk / Angkatan <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('tahun_masuk') is-invalid @enderror" id="tahun_masuk" name="tahun_masuk" value="{{ old('tahun_masuk', $siswa->tahun_masuk ?? date('Y')) }}" placeholder="Contoh: 2024" required>
                        @error('tahun_masuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn {{ isset($siswa) ? 'btn-warning' : 'btn-primary' }}">
                        <i class="bi bi-save me-1"></i> {{ isset($siswa) ? 'Simpan Perubahan' : 'Simpan Data Siswa' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
