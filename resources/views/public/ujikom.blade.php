@extends('layouts.public')
@section('title', 'Uji Kompetensi')
@section('content')
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card shadow mt-4 border-0">
                <h3 class="card-title text-center mt-4">Form Belanja</h3>
                <form action="#">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nama1" class="form-label">Nama Barang 1</label>
                            <input type="text" class="form-control" id="nama1" name="nama1" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga1" class="form-label">Harga Barang 1</label>
                            <input type="number" class="form-control" id="harga1" name="harga1" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama2" class="form-label">Nama Barang 2</label>
                            <input type="text" class="form-control" id="nama2" name="nama2" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga2" class="form-label">Harga Barang 2</label>
                            <input type="number" class="form-control" id="harga2" name="harga2" required>
                        </div>


                        @php
                            $total = 0;
                            $hadiah = '';

                            if (isset($_GET['harga1']) && isset($_GET['harga2'])) {
                                $total = $_GET['harga1'] + $_GET['harga2'];

                                if ($total > 500000) {
                                    $hadiah = 'Gelas Cantik';
                                } else {
                                    $hadiah = 'Pensil';
                                }
                            }
                        @endphp

                        <div class="mb-3 row justify-content-center">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">Hitung Total</button>
                            </div>
                        </div>
                        <hr>


                        @if (isset($_GET['harga1']) && isset($_GET['harga2']))
                            <h5 class="text-center">Hasil Belanja</h5>

                            <table class="table table-boarded">
                                <tr>
                                    <th>Nama Barang 1</th>
                                    <td>{{ $_GET['nama1'] }}</td>
                                </tr>
                                <tr>
                                    <th>Harga Barang 1</th>
                                    <td>Rp{{ number_format($_GET['harga1'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Barang 2</th>
                                    <td>{{ $_GET['nama2'] }}</td>
                                </tr>
                                <tr>
                                    <th>Harga Barang 2</th>
                                    <td>Rp{{ number_format($_GET['harga2'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Total Belanja</th>
                                    <td>Rp{{ number_format($_GET['harga1'] + $_GET['harga2'], 0, ',', '.') }}</td>
                                </tr>
                                    <th>Hadiah</th>
                                    <td>{{ $hadiah }}</td>
                                </tr>
                            </table>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
