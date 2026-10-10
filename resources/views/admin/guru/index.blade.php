@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Guru</h4>

                    <a href="{{ route('admin.guru.addEdit') }}"
                       class="btn btn-primary ms-auto"
                       style="border-radius: 10px">
                        <i class="fas fa-plus me-1"></i>
                        Tambah Guru
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabelGuru"
                           class="table table-bordered table-striped table-hover align-middle responsive nowrap"
                           width="100%">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama Guru</th>
                                <th>NIP</th>
                                <th>Mata Pelajaran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($guru as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        @if ($data->foto)
                                            <img src="{{ asset('storage/' . $data->foto) }}"
                                                 alt="Foto Guru"
                                                 width="60"
                                                 height="60"
                                                 class="rounded"
                                                 style="object-fit: cover;">
                                        @else
                                            <span class="badge bg-secondary">
                                                Tidak ada foto
                                            </span>
                                        @endif
                                    </td>

                                    <td>{{ $data->nama_guru }}</td>

                                    <td>{{ $data->nip }}</td>

                                    <td >{{ $data->mapel }}</td>

                                    <td class="text-center">
                                        <div class="btn-aksi-group">

                                            <a href="{{ route('admin.guru.addEdit', Crypt::encrypt($data->id_guru)) }}"
                                               class="btn btn-warning btn-sm text-white"
                                               title="Edit Guru"
                                               aria-label="Edit">
                                                <i class="fas fa-pen"></i>
                                                <span class="d-none d-md-inline ms-1">
                                                    Edit
                                                </span>
                                            </a>

                                            <form action="{{ route('admin.guru.destroy', Crypt::encrypt($data->id_guru)) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        title="Hapus Guru"
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

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Belum ada data guru.
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tabelGuru').DataTable({
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
    });
</script>
@endpush

@endsection
