@extends('layouts.app')
@section('title', 'Kelola User')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Data User</h4>

                        <a href="{{ route('admin.user.addEdit') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>
                            Tambah User
                        </a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table id="tableUser" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="60">No</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <i class="fas fa-user me-2 text-primary"></i>
                                            {{ $user->username }}
                                        </td>

                                        <td>
                                            @if ($user->role == 'Admin')
                                                <span class="badge badge-primary">
                                                    <i class="fas fa-user-shield me-1"></i>
                                                    Admin
                                                </span>
                                            @else
                                                <span class="badge badge-info">
                                                    <i class="fas fa-user-cog me-1"></i>
                                                    Operator
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-aksi-group">

                                                <a href="{{ route('admin.user.addEdit', Crypt::encrypt($user->id_user)) }}"
                                                    class="btn btn-warning btn-sm text-white" title="Edit User"
                                                    aria-label="Edit">
                                                    <i class="fas fa-pen"></i>
                                                    <span class="d-none d-md-inline ms-1">
                                                        Edit
                                                    </span>
                                                </a>

                                                <form
                                                    action="{{ route('admin.user.delete', Crypt::encrypt($user->id_user)) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus User"
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
            $('#tableUser').DataTable();
        });
    </script>
@endpush
