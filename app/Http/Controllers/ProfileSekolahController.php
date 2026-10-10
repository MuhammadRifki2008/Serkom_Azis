<?php

namespace App\Http\Controllers;

use App\Models\ProfileSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileSekolahController extends Controller
{
    public function index()
    {
        $profile = ProfileSekolah::first();

        return view('admin.profile-sekolah.index', compact('profile'));
    }

    public function publicProfile()
    {
        $profile = ProfileSekolah::first();

        return view('public.profill', compact('profile'));
    }

    public function edit()
    {
        $profile = ProfileSekolah::first();

        return view('admin.profile-sekolah.form', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah'   => 'required|max:40',
            'kepala_sekolah' => 'required|max:40',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3048',
            'foto_kepsek'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'npsn'           => 'required|max:10',
            'kontak'         => 'required|max:15',
            'alamat'         => 'required',
            'visi'           => 'required',
            'misi'           => 'required',
            'tahun_berdiri'  => 'required|digits:4',
            'deskripsi'      => 'required',
        ]);

        $profile = ProfileSekolah::first() ?? new ProfileSekolah();

        $profile->nama_sekolah   = $request->nama_sekolah;
        $profile->kepala_sekolah = $request->kepala_sekolah;
        $profile->npsn           = $request->npsn;
        $profile->kontak         = $request->kontak;
        $profile->alamat         = $request->alamat;
        $profile->visi           = $request->visi;
        $profile->misi           = $request->misi;
        $profile->tahun_berdiri  = $request->tahun_berdiri;
        $profile->deskripsi      = $request->deskripsi;

        foreach (['foto', 'foto_kepsek', 'logo'] as $field) {
            if (!$request->hasFile($field)) {
                continue;
            }

            if ($profile->$field && Storage::disk('public')->exists('profil/' . $profile->$field)) {
                Storage::disk('public')->delete('profil/' . $profile->$field);
            }

            $file = $request->file($field);
            $nama = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profil', $nama, 'public');

            $profile->$field = $nama;
        }

        $profile->save();

        return redirect()
            ->route('admin.profile')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
