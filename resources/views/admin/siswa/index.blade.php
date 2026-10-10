@extends('layouts.app')
@section('title', 'Data Siswa')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Siswa</h4>
                    <a href="{{ route('admin.siswa.addEdit') }}"
                       class="btn btn-primary ms-auto"
                       style="border-radius: 10px">
                        <i class="fas fa-plus me-1"></i>
                        Tambah Siswa
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabelSiswa" class="table table-bordered table-striped table-hover align-middle responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" data-priority="1" style="width: 40px;">No</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Jenis Kelamin</th>
                                <th>Tahun Masuk</th>
                                <th class="text-center" data-priority="1" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswa as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nisn }}</td>
                                    <td>{{ $item->nama_siswa }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->tahun_masuk }}</td>
                                    <td class="text-center">
                                        <div class="btn-aksi-group">
                                            <a href="{{ route('admin.siswa.addEdit', Crypt::encrypt($item->id_siswa)) }}"
                                               class="btn btn-warning btn-sm text-white"
                                               title="Edit Siswa"
                                               aria-label="Edit">
                                                <i class="fas fa-pen"></i>
                                                <span class="d-none d-md-inline ms-1">Edit</span>
                                            </a>

                                            <form action="{{ route('admin.siswa.destroy', Crypt::encrypt($item->id_siswa)) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        title="Hapus Siswa"
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
                                        Belum ada data siswa.
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
    $(document).ready(function () {
        $('#tabelSiswa').DataTable({
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
