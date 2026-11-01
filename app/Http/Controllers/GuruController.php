<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::with('user')->latest()->get();

        return view('guru.index', compact('gurus'));
    }

    public function create()
    {
        $guru = new Guru();

        return view('guru.form', compact('guru'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nip' => ['nullable', 'string', 'max:50', 'unique:gurus,nip'],
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                'unique:gurus,email',
                'unique:users,email',
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_telp' => ['nullable', 'string', 'max:30'],
            'jabatan' => ['nullable', 'string', 'max:100'],
        ]);

        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['nama'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'pendidik',
            ]);

            Guru::create([
                'nip' => $data['nip'] ?? null,
                'nama' => $data['nama'],
                'email' => $data['email'],
                'no_telp' => $data['no_telp'] ?? null,
                'jabatan' => $data['jabatan'] ?? null,
                'user_id' => $user->id,
            ]);
        });

        return redirect()->route('guru.index')
            ->with('success', 'Data guru dan akun login berhasil dibuat.');
    }

    public function edit(Guru $guru)
    {
        $guru->load('user');

        return view('guru.form', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'nip' => [
                'nullable', 'string', 'max:50',
                Rule::unique('gurus', 'nip')->ignore($guru->id),
            ],
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('gurus', 'email')->ignore($guru->id),
                Rule::unique('users', 'email')->ignore($guru->user_id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'no_telp' => ['nullable', 'string', 'max:30'],
            'jabatan' => ['nullable', 'string', 'max:100'],
        ]);

        DB::transaction(function () use ($data, $guru) {
            $guru->update([
                'nip' => $data['nip'] ?? null,
                'nama' => $data['nama'],
                'email' => $data['email'],
                'no_telp' => $data['no_telp'] ?? null,
                'jabatan' => $data['jabatan'] ?? null,
            ]);

            if ($guru->user) {
                $user = $guru->user;
                $user->name = $data['nama'];
                $user->email = $data['email'];

                if (!empty($data['password'])) {
                    $user->password = Hash::make($data['password']);
                }

                $user->save();
            } elseif (!empty($data['password'])) {
                $user = User::create([
                    'name' => $data['nama'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'role' => 'pendidik',
                ]);

                $guru->update(['user_id' => $user->id]);
            }
        });

        return redirect()->route('guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        DB::transaction(function () use ($guru) {
            // Hapus data guru saja; akun pengguna tetap dipertahankan.
            $guru->delete();
        });

        return redirect()->route('guru.index')
            ->with('success', 'Data guru berhasil dihapus. Akun login tetap tersimpan.');
    }
}