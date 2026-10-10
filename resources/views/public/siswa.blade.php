@extends('layouts.public')

@section('title', 'Siswa')

@section('content')

<section class="page-header text-white py-5">
    <div class="container">

        <h1 class="fw-bold mb-2">
            Siswa
        </h1>

        <p class="mb-0">
            Data siswa sekolah
        </p>

    </div>
</section>

<section class="py-5">
    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold text-primary">
                Data Siswa
            </h2>

            <p class="text-muted">
                Daftar siswa {{ $profile->nama_sekolah ?? 'SDN MOCH TOHA' }}
            </p>

        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-primary">

                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="py-3">NISN</th>
                                <th class="py-3">Nama Siswa</th>
                                <th class="py-3">Jenis Kelamin</th>
                                <th class="py-3">Tahun Masuk</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($siswa as $item)

                                <tr>

                                    <td class="px-4">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $item->nisn }}
                                    </td>

                                    <td>
                                        <strong>{{ $item->nama_siswa }}</strong>
                                    </td>

                                    <td>
                                        {{ ucfirst($item->jenis_kelamin) }}
                                    </td>

                                    <td>
                                        {{ $item->tahun_masuk }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center py-5 text-muted">
                                        Data siswa belum tersedia.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection
