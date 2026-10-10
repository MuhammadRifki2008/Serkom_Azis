@extends('layouts.app')
@section('title', isset($user) ? 'Edit User' : 'Tambah User')
@section('content')


    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card card-round">
                <div class="card-header"> 
                    <h4 class="card-title">
                        <i class="fas fa-user-cog me-2"></i>
                        {{ isset($user) ? 'Edit User' : 'Tambah User' }}
                    </h4>
                </div>

                <div class="card-body">

                    <form
                        action="{{ isset($user) ? route('admin.user.save', Crypt::encrypt($user->id_user)) : route('admin.user.save') }}"
                        method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">
                                Username
                            </label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>

                                <input type="text" name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username', $user->username ?? '') }}" placeholder="Masukkan username">

                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Password
                            </label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>

                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="{{ isset($user) ? 'Kosongkan jika tidak diubah' : 'Masukkan password' }}">

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            @if (isset($user))
                                <small class="text-muted">
                                    Kosongkan password jika tidak ingin mengubahnya.
                                </small>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Role
                            </label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user-shield"></i>
                                </span>

                                <select name="role" class="form-select @error('role') is-invalid @enderror">

                                    <option value="">Pilih Role</option>

                                    <option value="Admin"
                                        {{ old('role', $user->role ?? '') == 'Admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                    <option value="Operator"
                                        {{ old('role', $user->role ?? '') == 'Operator' ? 'selected' : '' }}>
                                        Operator
                                    </option>

                                </select>

                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                {{ isset($user) ? 'Simpan Perubahan' : 'Simpan User' }}
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
