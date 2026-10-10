@extends('layouts.app')

@section('title', 'Kelola Galeri')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center">

                        <h4 class="card-title">
                            Daftar Dokumentasi Galeri
                        </h4>

                        <a href="{{ route('admin.galeri.addEdit') }}" class="btn btn-primary ms-auto"
                            style="border-radius: 10px">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Galeri
                        </a>

                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table id="tabelGaleri"
                            class="table table-bordered table-striped table-hover align-middle responsive nowrap"
                            width="100%">

                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Media</th>
                                    <th>Judul Dokumentasi</th>
                                    <th class="text-center">Kategori</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($galeri as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            @if ($item->kategori == 'Video')
                                                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#videoModal{{ $item->id_galeri }}" title="Putar Video">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                            @elseif ($item->file && file_exists(public_path('storage/' . $item->file)))
                                                <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->judul }}"
                                                    class="rounded shadow-sm"
                                                    style="width: 60px; height: 42px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary-subtle rounded d-inline-flex align-items-center justify-content-center text-secondary"
                                                    style="width: 60px; height: 42px;">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-semibold">
                                                {{ $item->judul }}
                                            </div>
                                            @if ($item->keterangan)
                                                <small class="text-muted d-none d-lg-block">
                                                    {{ Str::limit($item->keterangan, 60) }}
                                                </small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="badge {{ $item->kategori == 'Foto' ? 'bg-success' : 'bg-danger' }}">
                                                <i
                                                    class="fas {{ $item->kategori == 'Foto' ? 'fa-image' : 'fa-video' }} me-1"></i>
                                                {{ $item->kategori }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ date('d M Y', strtotime($item->tanggal)) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-aksi-group">
                                                <a href="{{ route('admin.galeri.addEdit', Crypt::encrypt($item->id_galeri)) }}"
                                                    class="btn btn-warning btn-sm text-white" title="Edit Galeri">
                                                    <i class="fas fa-pen"></i>
                                                    <span class="d-none d-md-inline ms-1">
                                                        Edit
                                                    </span>
                                                </a>
                                                <form
                                                    action="{{ route('admin.galeri.destroy', Crypt::encrypt($item->id_galeri)) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Hapus Galeri">
                                                        <i class="fas fa-trash"></i>
                                                        <span class="d-none d-md-inline ms-1">
                                                            Hapus
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @if ($item->kategori == 'Video')
                                        <div class="modal fade" id="videoModal{{ $item->id_galeri }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <i class="fas fa-video me-1"></i>
                                                            {{ $item->judul }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <video controls
                                                            style="width: 100%; max-height: 600px; background: #000;"
                                                            preload="metadata">
                                                            <source src="{{ asset('storage/' . $item->file) }}"
                                                                type="video/mp4">
                                                            Browser kamu tidak mendukung video.
                                                        </video>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Belum ada data galeri.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#tabelGaleri').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "Showing 0 to 0 entries",
                    zeroRecords: "No matching records found",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });

            $('.modal').on('hidden.bs.modal', function() {
                const video = $(this).find('video')[0];

                if (video) {
                    video.pause();
                    video.currentTime = 0;
                }
            });

        });
    </script>
@endpush
