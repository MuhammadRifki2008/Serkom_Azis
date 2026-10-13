@extends('layouts.app')
@section('title', 'Kelola Ekstrakurikuler')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Daftar Ekstrakurikuler</h4>
                        <a href="{{ route('admin.ekstrakurikuler.addEdit') }}" class="btn btn-primary ms-auto"
                            style="border-radius: 10px">
                            <i class="fa fa-plus me-1"></i>Tambah Ekstrakurikuler
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="tabelEskul"
                            class="table table-bordered table-striped table-hover align-middle responsive nowrap"
                            width="100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" data-priority="1" style="width: 40px;">No</th>
                                    <th class="text-center" data-priority="2" style="width: 75px;">Gambar</th>
                                    <th data-priority="1">Nama Ekstrakurikuler</th>
                                    <th data-priority="3">Pembina</th>
                                    <th data-priority="4">Jadwal Latihan</th>
                                    <th class="text-center" data-priority="1" style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ekstrakurikuler as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            @if ($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                                    alt="{{ $item->nama_eskul }}" class="rounded shadow-sm"
                                                    style="width: 60px; height: 42px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary-subtle rounded d-inline-flex align-items-center justify-content-center text-secondary"
                                                    style="width: 60px; height: 42px;">
                                                    <i class="bi bi-trophy fs-5"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="fw-semibold">{{ $item->nama_eskul }}</td>
                                        <td>
                                            <span class="badge text-bg-secondary">
                                                <i
                                                    class="bi bi-person-badge me-1"></i>{{ $item->pembina ?? 'Belum ditentukan' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge text-bg-light border">
                                                <i class="bi bi-clock me-1"></i>{{ $item->jadwal_latihan }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-aksi-group">

                                                <a href="{{ route('admin.ekstrakurikuler.addEdit', Crypt::encrypt($item->id_eskul)) }}"
                                                    class="btn btn-warning btn-sm text-white" title="Edit Ekstrakurikuler"
                                                    aria-label="Edit">
                                                    <i class="fas fa-pen"></i>
                                                    <span class="d-none d-md-inline ms-1">
                                                        Edit
                                                    </span>
                                                </a>

                                                <form
                                                    action="{{ route('admin.ekstrakurikuler.destroy', Crypt::encrypt($item->id_eskul)) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus Ekstrakurikuler"
                                                        aria-label="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                        <span class="d-none d-md-inline ms-1">
                                                            Hapus
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
            $('#tabelEskul').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "Showing 0 to 0 of 0 entries",
                    zeroRecords: "No matching records found",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });
        });
    </script>
@endpush
