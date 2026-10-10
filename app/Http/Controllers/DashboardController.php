<?php

namespace App\Http\Controllers;

use App\Models\berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\ProfileSekolah;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $jumlahGuru = Guru::count();
        $jumlahSiswa = Siswa::count();
        $jumlahBerita = berita::count();
        $jumlahGaleri = Galeri::count();
        $jumlahUser = User::count();
        $jumlahEkstrakurikuler = Ekstrakurikuler::count();

        $beritaTerbaru = berita::orderBy('tanggal', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'jumlahGuru',
            'jumlahSiswa',
            'jumlahBerita',
            'jumlahGaleri',
            'jumlahEkstrakurikuler',
            'beritaTerbaru',
            'jumlahUser'
        ));
    }

   public function publicDashboard()
    {
        $profile = ProfileSekolah::first();
        $guru = Guru::take(4)->get();
        $siswa = Siswa::all();
        $beritas = Berita::orderBy('tanggal', 'desc')->take(3)->get();
        $ekstrakurikuler = Ekstrakurikuler::take(4)->get();
        $galeri = Galeri::orderBy('tanggal', 'desc')->take(6)->get();

        return view('public.dashboard', compact(
            'profile',
            'guru',
            'siswa',
            'beritas',
            'ekstrakurikuler',
            'galeri'
        ));
    }
}
