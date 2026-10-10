<?php

namespace App\Http\Controllers;

use App\Models\berita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = berita::all();
        return view('admin.berita.index', compact('berita'));
    }

    public function addEdit($id = null)
    {
        try {
            $berita = $id
                ? Berita::findOrFail(Crypt::decrypt($id))
                : null;
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        return view('admin.berita.form', compact('berita'));
    }

    public function save(Request $request, $id = null)
    {
        if ($id) {
            try {
                $id = Crypt::decrypt($id);
                $berita = Berita::findOrFail($id);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.berita.index')
                    ->with('error', 'Data berita tidak ditemukan.');
            }
        } else {
            $berita = new Berita();
            $berita->id_user = Auth::id() ?? User::value('id_user');
        }

        $request->validate([
            'judul'   => 'required|string|max:50',
            'isi'     => 'required|string',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'judul.required'   => 'Judul berita wajib diisi.',
            'judul.max'        => 'Judul maksimal 50 karakter.',
            'isi.required'     => 'Isi berita wajib diisi.',
            'tanggal.required' => 'Tanggal publikasi wajib diisi.',
            'gambar.image'     => 'Gambar harus berupa file gambar (JPG, PNG).',
            'gambar.max'       => 'Ukuran gambar maksimal 2MB.',
        ]);

        $berita->judul   = $request->judul;
        $berita->isi     = $request->isi;
        $berita->tanggal = $request->tanggal;

        if ($request->hasFile('gambar')) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $berita->gambar = $request->file('gambar')->store('berita', 'public');
        }

        $berita->save();

        return redirect()->route('admin.berita.index')->with(
            'success',
            $id
                ? 'Data berita berhasil diperbarui.'
                : 'Data berita berhasil disimpan.'
        );
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
    public function show(berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(berita $berita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, berita $berita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail(Crypt::decrypt($id));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Data berita berhasil dihapus.');
    }

    public function publicBerita()
    {
        $berita = berita::orderBy('tanggal', 'desc')->paginate(6);

        return view('public.berita', compact('berita'));
    }

    public function publicBeritaDetail($id)
    {
        $berita = berita::where('id_berita', $id)->firstOrFail();

        return view('public.berita-detail', compact('berita'));
    }
}
