<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::all();

        return view('admin.galeri.index', compact('galeri'));
    }

    public function publicGaleri()
    {
        $galeri = Galeri::orderBy('tanggal', 'desc')->paginate(6);

        return view('public.galeri', compact('galeri'));
    }
    public function publicGaleriDetail($id)
    {
        $galeri = Galeri::where('id_galeri', $id)->firstOrFail();

        return view('public.galeri-detail', compact('galeri'));
    }

    public function addEdit($id = null)
    {
        try {
            $galeri = $id
                ? Galeri::findOrFail(Crypt::decrypt($id))
                : null;
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.galeri.index')
                ->with('error', 'Data galeri tidak ditemukan');
        }

        return view('admin.galeri.form', compact('galeri'));
    }

    public function save(Request $request, $id = null)
    {
        if ($id) {
            try {
                $id = Crypt::decrypt($id);
                $galeri = Galeri::findOrFail($id);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.galeri.index')
                    ->with('error', 'Data galeri tidak ditemukan');
            }
        } else {
            $galeri = new Galeri();
        }

        $oldKategori = $galeri->kategori;

        $rules = [
            'judul' => 'required|string|max:50',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ];

        if ($request->kategori === 'Foto') {
            $rules['file'] = $id
                ? 'nullable|image|mimes:jpg,jpeg,png|max:10240'
                : 'required|image|mimes:jpg,jpeg,png|max:10240';
        }

        if ($request->kategori === 'Video') {
            $rules['file'] = $id
                ? 'nullable|file|mimes:mp4,webm,ogg|max:51200'
                : 'required|file|mimes:mp4,webm,ogg|max:51200';
        }

        $request->validate($rules, [
            'judul.required' => 'Judul dokumentasi wajib diisi',
            'judul.max' => 'Judul maksimal 50 karakter',
            'kategori.required' => 'Pilih kategori media',
            'tanggal.required' => 'Tanggal dokumentasi wajib diisi',
            'file.required' => 'File wajib diunggah',
            'file.image' => 'File harus berupa gambar',
            'file.mimes' => 'Format file tidak didukung',
            'file.max' => 'Ukuran file maksimal 50MB',
        ]);

        $galeri->judul = $request->judul;
        $galeri->kategori = $request->kategori;
        $galeri->tanggal = $request->tanggal;
        $galeri->keterangan = $request->keterangan;

        if ($request->hasFile('file')) {
            if ($galeri->file && $oldKategori === 'Foto') {
                if (Storage::disk('public')->exists($galeri->file)) {
                    Storage::disk('public')->delete($galeri->file);
                }
            }

            if ($galeri->file && $oldKategori === 'Video') {
                if (Storage::disk('public')->exists($galeri->file)) {
                    Storage::disk('public')->delete($galeri->file);
                }
            }

            $galeri->file = $request->file('file')->store('galeri', 'public');
        }

        $galeri->save();

        return redirect()
            ->route('admin.galeri.index')
            ->with(
                'success',
                $id
                    ? 'Dokumentasi galeri berhasil diperbarui'
                    : 'Dokumentasi galeri berhasil ditambahkan'
            );
    }

    public function destroy($id)
    {
        try {
            $galeri = Galeri::findOrFail(Crypt::decrypt($id));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.galeri.index')
                ->with('error', 'Data galeri tidak ditemukan');
        }

        if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Data galeri berhasil dihapus');
    }
}
