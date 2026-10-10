@extends('layouts.app')

@section('title', isset($galeri) ? 'Edit Galeri' : 'Tambah Galeri')

@section('content')

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow mb-4 border-0">

            <div class="card-header {{ isset($galeri) ? 'bg-warning text-dark' : 'bg-primary text-white' }}">
                <h3 class="card-title mb-0">
                    <i class="fas {{ isset($galeri) ? 'fa-edit' : 'fa-plus' }} me-1"></i>
                    {{ isset($galeri) ? 'Form Edit Data Galeri' : 'Form Tambah Data Galeri' }}
                </h3>
            </div>

            <form action="{{ route('admin.galeri.save', isset($galeri) ? Crypt::encrypt($galeri->id_galeri) : null) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="card-body">

                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold">
                            Judul Dokumentasi
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               maxlength="50"
                               class="form-control @error('judul') is-invalid @enderror"
                               id="judul"
                               name="judul"
                               value="{{ old('judul', $galeri->judul ?? '') }}"
                               placeholder="Masukkan judul dokumentasi"
                               required>

                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="kategori" class="form-label fw-semibold">
                                Kategori Media
                                <span class="text-danger">*</span>
                            </label>

                            <select class="form-select @error('kategori') is-invalid @enderror"
                                    id="kategori"
                                    name="kategori"
                                    required>

                                <option value="Foto"
                                    {{ old('kategori', $galeri->kategori ?? 'Foto') == 'Foto' ? 'selected' : '' }}>
                                    Foto
                                </option>

                                <option value="Video"
                                    {{ old('kategori', $galeri->kategori ?? '') == 'Video' ? 'selected' : '' }}>
                                    Video
                                </option>

                            </select>

                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label fw-semibold">
                                Tanggal Dokumentasi
                                <span class="text-danger">*</span>
                            </label>

                            <input type="date"
                                   class="form-control @error('tanggal') is-invalid @enderror"
                                   id="tanggal"
                                   name="tanggal"
                                   value="{{ old('tanggal', isset($galeri) ? $galeri->tanggal : date('Y-m-d')) }}"
                                   required>

                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="mb-3">

                        <div id="fotoInput">

                            <label for="foto" class="form-label fw-semibold">
                                {{ isset($galeri) ? 'Ganti Foto' : 'Foto Dokumentasi' }}

                                @if (!isset($galeri))
                                    <span class="text-danger">*</span>
                                @endif
                            </label>

                            <input type="file"
                                   class="form-control @error('file') is-invalid @enderror"
                                   id="foto"
                                   name="file"
                                   accept="image/jpeg,image/jpg,image/png">

                            <small class="text-muted">
                                Format JPG, JPEG, PNG. Maksimal 10MB.
                            </small>

                        </div>

                        <div id="videoInput" style="display: none;">

                            <label for="video" class="form-label fw-semibold">
                                {{ isset($galeri) ? 'Ganti Video' : 'Video Dokumentasi' }}

                                @if (!isset($galeri))
                                    <span class="text-danger">*</span>
                                @endif
                            </label>

                            <input type="file"
                                   class="form-control @error('file') is-invalid @enderror"
                                   id="video"
                                   name="file"
                                   accept="video/mp4,video/webm,video/ogg">

                            <small class="text-muted">
                                Format MP4, WEBM, OGG. Maksimal 50MB.
                            </small>

                        </div>

                        @error('file')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                        @if (isset($galeri) && $galeri->file)

                            <div class="mt-3">

                                <small class="text-secondary d-block">
                                    Media saat ini:
                                </small>

                                @if ($galeri->kategori == 'Video')

                                    <video controls
                                           class="mt-2 rounded"
                                           style="width: 300px; max-width: 100%;">
                                        <source src="{{ asset('storage/' . $galeri->file) }}">
                                    </video>

                                @else

                                    <img src="{{ asset('storage/' . $galeri->file) }}"
                                         alt="{{ $galeri->judul }}"
                                         class="rounded shadow-sm mt-2"
                                         style="width: 150px; height: 100px; object-fit: cover;">

                                @endif

                            </div>

                        @endif

                    </div>

                    <div class="mb-3">

                        <label for="keterangan" class="form-label fw-semibold">
                            Keterangan / Deskripsi
                        </label>

                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                  id="keterangan"
                                  name="keterangan"
                                  rows="3"
                                  placeholder="Tuliskan keterangan dokumentasi">{{ old('keterangan', $galeri->keterangan ?? '') }}</textarea>

                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="card-footer">

                    <div class="d-flex justify-content-between">

                        <a href="{{ route('admin.galeri.index') }}"
                           class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>
                            Kembali
                        </a>

                        <button type="submit"
                                class="btn {{ isset($galeri) ? 'btn-warning' : 'btn-primary' }}">
                            <i class="fas fa-save me-1"></i>
                            {{ isset($galeri) ? 'Simpan Perubahan' : 'Unggah Dokumentasi' }}
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    $(document).ready(function () {

        const isEdit = {{ isset($galeri) ? 'true' : 'false' }};

        function toggleMediaInput() {

            const kategori = $('#kategori').val();

            if (kategori === 'Video') {

                $('#fotoInput').hide();
                $('#videoInput').show();

                $('#foto').prop('disabled', true);
                $('#video').prop('disabled', false);

                if (!isEdit || '{{ $galeri->kategori ?? '' }}' !== 'Video') {
                    $('#video').prop('required', true);
                }

                $('#foto').prop('required', false);

            } else {

                $('#fotoInput').show();
                $('#videoInput').hide();

                $('#foto').prop('disabled', false);
                $('#video').prop('disabled', true);

                if (!isEdit || '{{ $galeri->kategori ?? '' }}' !== 'Foto') {
                    $('#foto').prop('required', true);
                }

                $('#video').prop('required', false);
            }
        }

        toggleMediaInput();

        $('#kategori').on('change', function () {

            const kategori = $(this).val();

            if (kategori === 'Foto') {
                $('#foto').prop('required', true);
            } else {
                $('#video').prop('required', true);
            }

            toggleMediaInput();
        });

    });
</script>

@endpush
