<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function addEdit($id = null)
    {
        try {
            $user = $id
                ? User::findOrFail(Crypt::decrypt($id))
                : null;
        } catch (\Exception $e) {
            return redirect()->route('admin.user.index')->with('error', 'Data user tidak ditemukan');
        }

        return view('admin.user.form', compact('user'));
    }

    public function save(Request $request, $id = null)
    {
        if ($id) {
            try {
                $id = Crypt::decrypt($id);
                $user = User::findOrFail($id);
            } catch (\Exception $e) {
                return redirect()->route('admin.user.index')->with('error', 'Data user tidak ditemukan');
            }
        } else {
            $user = new User();
        }

        $request->validate([
            'username' => 'required|string|max:30|unique:users,username,' . ($id ?? 'NULL') . ',id_user',
            'role' => 'required|in:Admin,Operator',
            'password' => $id ? 'nullable|min:6|max:100' : 'required|min:6|max:100',
        ], [
            'username.required' => 'Username wajib diisi',
            'username.max' => 'Username maksimal 30 karakter',
            'username.unique' => 'Username sudah digunakan',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.max' => 'Password maksimal 100 karakter',
        ]);

        $user->username = $request->username;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('admin.user.index')
            ->with(
                'success',
                $id
                    ? 'Data user berhasil diperbarui'
                    : 'Data user berhasil disimpan'
            );
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail(Crypt::decrypt($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.user.index')->with('error', 'Data user tidak ditemukan');
        }

        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Data user berhasil dihapus');
    }

}
