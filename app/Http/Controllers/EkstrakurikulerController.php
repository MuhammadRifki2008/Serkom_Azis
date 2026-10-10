<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('admin.ekstrakurikuler.index', compact('ekstrakurikuler'));
    }

    public function addEdit($id = null)
    {
        try {
            $ekstrakurikuler = $id ? Ekstrakurikuler::findOrFail(Crypt::decrypt($id)) : null;
        } catch (\Exception $e) {
            return redirect()->route('admin.ekstrakurikuler.index')->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }

        return view('admin.ekstrakurikuler.form', compact('ekstrakurikuler'));
    }

    public function publicEkstrakurikuler()
    {
        $ekstrakurikuler = Ekstrakurikuler::orderBy('id_eskul', 'desc')->paginate(6);

        return view('public.ekstrakurikuler', compact('ekstrakurikuler'));
    }

    public function publicEkstrakurikulerDetail($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::where('id_eskul', $id)->firstOrFail();

        return view('public.ekstrakurikuler-detail', compact('ekstrakurikuler'));
    }

    public function save(Request $request, $id = null)
    {
        if ($id) {
            try {
                $id = Crypt::decrypt($id);
                $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
            } catch (\Exception $e) {
                return redirect()->route('admin.ekstrakurikuler.index')->with('error', 'Data ekstrakurikuler tidak ditemukan.');
            }
        } else {
            $ekstrakurikuler = new Ekstrakurikuler();
        }

        $request->validate([
            'nama_eskul'    => 'required|string|max:40',
            'pembina'       => 'required|string|max:40',
            'jadwal_latihan' => 'required|string|max:40',
            'deskripsi'     => 'nullable|string',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_eskul.required' => 'Nama ekstrakurikuler wajib diisi.',
            'nama_eskul.max' => 'Nama ekstrakurikuler maksimal 40 karakter.',
            'pembina.required' => 'Pembina wajib diisi.',
            'jadwal_latihan.required' => 'Jadwal latihan wajib diisi.',
            'jadwal_latihan.max' => 'Jadwal latihan maksimal 40 karakter.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $ekstrakurikuler->nama_eskul = $request->nama_eskul;
        $ekstrakurikuler->pembina = $request->pembina;
        $ekstrakurikuler->jadwal_latihan = $request->jadwal_latihan;
        $ekstrakurikuler->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            if ($ekstrakurikuler->gambar && Storage::disk('public')->exists($ekstrakurikuler->gambar)) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar);
            }

            $ekstrakurikuler->gambar = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        $ekstrakurikuler->save();

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', $id ? 'Data ekstrakurikuler berhasil diperbarui.' : 'Data ekstrakurikuler berhasil disimpan.');
    }

    public function destroy($id)
    {
        try {
            $ekstrakurikuler = Ekstrakurikuler::findOrFail(Crypt::decrypt($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.ekstrakurikuler.index')->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }

        if ($ekstrakurikuler->gambar && Storage::disk('public')->exists($ekstrakurikuler->gambar)) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
        }

        $ekstrakurikuler->delete();

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Data ekstrakurikuler berhasil dihapus.');
    }
}
