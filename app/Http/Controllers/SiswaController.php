<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all();
        return view('admin.siswa.index', compact('siswa'));
    }

    public function publicSiswa()
    {
        return view('public.landing');
    }

    public function addEdit($id = null)
    {
        try{
            $siswa = $id
                ? Siswa::findOrFail(Crypt::decrypt($id))
                : null;
        }catch (\Exception $e) {
            return redirect()->route('admin.siswa.index')->with('error', 'Data siswa tidak ditemukan');
        }

        return view('admin.siswa.form', compact('siswa'));
    }

    public function save(Request $request, $id = null)
    {
        // Jika ada ID, berarti sedang mengubah data
        if ($id) {
            try {
                $id = Crypt::decrypt($id);
                $siswa = Siswa::findOrFail($id);
            }catch(\Exception $e){
                return redirect('admin.siswa.index')->with('error', 'Data siswa tidak ditemukan');
            }
        }else {
            // Jika tidak ada ID, berarti menambah data baru
            $siswa = new Siswa();
        }

        // Validasi input
        $request->validate([
            'nisn'          => 'required|digits:10|unique:siswa,nisn,' . ($id ?? 'NULL') . ',id_siswa',
            'nama_siswa'    => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk'   => 'required|digits:4|integer'
        ],
        [
            'nisn.required'          => 'NISN wajib diisi',
            'nisn.digits'            => 'NISN harus 10 digit angka',
            'nisn.unique'            => 'NISN sudah terdaftar pada siswa lain',
            'nama_siswa.required'    => 'Nama siswa wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'tahun_masuk.required'   => 'Tahun masuk wajib diisi',
            'tahun_masuk.digits'     => 'Tahun masuk harus 4 digit angka'
        ]);

        // Masukan data ke model
        $siswa->nisn = $request->nisn;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tahun_masuk = $request->tahun_masuk;

        // Simpan data
        $siswa->save();

        return redirect()
            ->route('admin.siswa.index')
            ->with(
                'success',
                $id
                    ? 'Data berhasil diperbarui'
                    : 'Data berhasil disimpan'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $siswa = Siswa::findOrFail(Crypt::decrypt($id));
        }catch(\Exception $e){
            return redirect()->route('admin.siswa.index')->with('error', 'Data siswa tidak ditemukan');
        }

        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
    }

}
