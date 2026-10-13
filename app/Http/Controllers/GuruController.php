<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        return view('admin.guru.index', compact('guru'));
    }

    public function publicGuru()
    {
        $guru = Guru::paginate(8);

        return view('public.guru', compact('guru'));
    }

    public function publicGuruDetail($id)
    {
        $guru = Guru::findOrFail($id);
        return view('public.guru-detail', compact('guru'));
    }

    public function addEdit($id = null)
    {
        try {
            $guru = $id
                ? Guru::findOrFail(Crypt::decrypt($id))
                : null;
        } catch (\Exception $e) {
            return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan');
        }

        return view('admin.guru.form', compact('guru'));
    }

    public function save(Request $request, $id = null)
    {
        if ($id) {
            try {
                $guru = Guru::findOrFail(Crypt::decrypt($id));
            } catch (\Exception $e) {
                return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan');
            }
        } else {
            $guru = new Guru();
        }

        $request->validate([
            'nama_guru' => 'required|string|max:40',
            'nip'       => [
                'required',
                'digits:10',
                Rule::unique('guru', 'nip')->ignore($guru->id_guru, 'id_guru'),
            ],
            'mapel'     => 'required|string|max:40',
            'foto'      => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ], [
            'nama_guru.required' => 'Nama wajib diisi',
            'nip.required'       => 'NIP wajib diisi',
            'nip.unique'         => 'Nip sudah terdaftar pada guru lain',
            'nip.digits'         => 'Harus 10 digit',
            'mapel.required'     => 'Mata pelajaran wajib diisi',
            'foto.image'         => 'Foto harus berupa file (png, jpg)',
            'foto.max'           => 'Ukuran foto maksimal 2mb',
        ]);

        $guru->nama_guru = $request->nama_guru;
        $guru->nip       = $request->nip;
        $guru->mapel     = $request->mapel;

        if ($request->hasFile('foto')) {
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }
            $guru->foto = $request->file('foto')->store('guru', 'public');
        }

        $guru->save();

        return redirect()->route('admin.guru.index')->with(
            'success',
            $id
                ? 'Data guru berhasil diperbarui'
                : 'Data guru berhasil ditambahkan'
        );
    }

    public function destroy($id)
    {
        try {
            $guru = Guru::findOrFail(Crypt::decrypt($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan');
        }

        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus');
    }
}
