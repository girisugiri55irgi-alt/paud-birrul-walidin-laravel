<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('orangTua')->latest()->get();

        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nis' => ['required', 'string', 'max:50', 'unique:siswas,nis'],
            'nama' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => [
                'required',
                Rule::in(['Laki-laki', 'Perempuan']),
            ],
            'kelas' => ['nullable', 'string', 'max:100'],
            'nama_orang_tua' => ['required', 'string', 'max:255'],

            // Data akun login orang tua
            'email_orang_tua' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password_orang_tua' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['nama_orang_tua'],
                'email' => $data['email_orang_tua'],
                'password' => Hash::make($data['password_orang_tua']),
                'role' => 'orang_tua',
            ]);

            Siswa::create([
                'nis' => $data['nis'],
                'nama' => $data['nama'],
                'tanggal_lahir' => $data['tanggal_lahir'] ?? null,
                'jenis_kelamin' => $data['jenis_kelamin'],
                'kelas' => $data['kelas'] ?? null,
                'nama_orang_tua' => $data['nama_orang_tua'],
                'user_id' => $user->id,
            ]);
        });

        return redirect()->route('siswa.index')
            ->with(
                'success',
                'Data murid dan akun login orang tua berhasil ditambahkan.'
            );
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
            'nis' => [
                'required',
                'string',
                'max:50',
                Rule::unique('siswas', 'nis')->ignore($siswa->id),
            ],
            'nama' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => [
                'required',
                Rule::in(['Laki-laki', 'Perempuan']),
            ],
            'kelas' => ['nullable', 'string', 'max:100'],
            'nama_orang_tua' => ['required', 'string', 'max:255'],
        ]);

        $siswa->update($data);

        // Perbarui nama akun orang tua jika akun sudah terhubung.
        if ($siswa->orangTua) {
            $siswa->orangTua->update([
                'name' => $data['nama_orang_tua'],
            ]);
        }

        return redirect()->route('siswa.index')
            ->with('success', 'Data murid berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        // Data akun orang tua tidak dihapus otomatis.
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Data murid berhasil dihapus.');
    }
}