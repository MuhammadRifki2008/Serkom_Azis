<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    private function bolehKelola(berita $berita): bool
    {
        $user = Auth::user();

        return $user !== null && (
            $user->role === 'Admin' ||
            (int) $berita->id_user === (int) Auth::id()
        );
    }

    public function index()
    {
        $berita = berita::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.berita.index', compact('berita'));
    }

    public function addEdit($id = null)
    {
        $berita = null;

        if ($id !== null && $id !== '') {
            $berita = berita::find($id);

            if (!$berita) {
                return redirect()
                    ->route('admin.berita.index')
                    ->with('error', 'Data berita tidak ditemukan.');
            }

            abort_unless(
                $this->bolehKelola($berita),
                403,
                'Kamu tidak memiliki izin mengedit berita ini.'
            );
        }

        return view('admin.berita.form', compact('berita'));
    }

    public function save(Request $request, $id = null)
    {
        $isUpdate = $id !== null && $id !== '';

        if ($isUpdate) {
            $berita = berita::find($id);

            if (!$berita) {
                return redirect()
                    ->route('admin.berita.index')
                    ->with('error', 'Data berita tidak ditemukan.');
            }

            abort_unless(
                $this->bolehKelola($berita),
                403,
                'Kamu tidak memiliki izin mengedit berita ini.'
            );
        } else {
            abort_unless(
                Auth::check() &&
                    in_array(Auth::user()->role, ['Admin', 'Operator'], true),
                403
            );

            $berita = new berita();
            $berita->id_user = Auth::id();
            $berita->gambar = '';
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
            'gambar.image'     => 'File harus berupa gambar.',
            'gambar.mimes'     => 'Gambar harus berformat JPG atau PNG.',
            'gambar.max'       => 'Ukuran gambar maksimal 2MB.',
        ]);

        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->tanggal = $request->tanggal;

        if ($request->hasFile('gambar')) {
            if (
                $berita->gambar &&
                Storage::disk('public')->exists($berita->gambar)
            ) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $berita->gambar = $request->file('gambar')
                ->store('berita', 'public');
        }

        $berita->save();

        return redirect()
            ->route('admin.berita.index')
            ->with(
                'success',
                $isUpdate
                    ? 'Data berita berhasil diperbarui.'
                    : 'Data berita berhasil disimpan.'
            );
    }

    public function create()
    {
        return $this->addEdit();
    }

    public function store(Request $request)
    {
        return $this->save($request);
    }

    public function show(berita $berita)
    {
        return redirect()->route('admin.berita.index');
    }

    public function edit(berita $berita)
    {
        abort_unless($this->bolehKelola($berita), 403);

        return $this->addEdit($berita->id_berita);
    }

    public function update(Request $request, berita $berita)
    {
        abort_unless($this->bolehKelola($berita), 403);

        return $this->save($request, $berita->id_berita);
    }

    public function destroy($id)
    {
        $berita = berita::find($id);

        if (!$berita) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        abort_unless(
            $this->bolehKelola($berita),
            403,
            'Kamu tidak memiliki izin menghapus berita ini.'
        );

        if (
            $berita->gambar &&
            Storage::disk('public')->exists($berita->gambar)
        ) {
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
        $berita = berita::findOrFail($id);

        return view('public.berita-detail', compact('berita'));
    }
}
