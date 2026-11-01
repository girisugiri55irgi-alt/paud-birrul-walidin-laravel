<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranSpmb;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpmbController extends Controller
{
// Memastikan hanya Admin yang dapat mengelola SPMB
    private function pastikanAdmin(): void
    {
        abort_unless(
            auth()->check() &&
            auth()->user()->role === 'administrator',
            403,
            'Anda tidak memiliki akses ke halaman Admin SPMB.'
        );
    }

    // Daftar seluruh pendaftar
    public function adminIndex(Request $request)
    {
        $this->pastikanAdmin();

        $query = PendaftaranSpmb::query();

        if ($request->filled('q')) {
            $kata = $request->q;

            $query->where(function ($sub) use ($kata) {
                $sub->where('nama_calon', 'like', "%{$kata}%")
                    ->orWhere('nomor_pendaftaran', 'like', "%{$kata}%");
            });
        }

        $pendaftars = $query->latest()->paginate(10)->withQueryString();

        return view('spmb.admin', compact('pendaftars'));
    }
public function adminDestroy($id)
{
    $this->pastikanAdmin();

    $pendaftaran = PendaftaranSpmb::findOrFail($id);
    $pendaftaran->delete();

    return redirect()
        ->route('admin.spmb.index')
        ->with('success', 'Data pendaftar SPMB berhasil dihapus.');
}
    // Detail pendaftar
    public function adminShow($id)
    {
        $this->pastikanAdmin();

        $pendaftaran = PendaftaranSpmb::findOrFail($id);

        return view('spmb.admin-detail', compact('pendaftaran'));
    }

    // Mengubah status seleksi
    public function adminUpdateStatus(Request $request, $id)
    {
        $this->pastikanAdmin();

        $data = $request->validate([
            'status' => 'required|in:menunggu,diterima,tidak_diterima',
            'catatan_seleksi' => 'nullable|string|max:2000',
        ]);

        $pendaftaran = PendaftaranSpmb::findOrFail($id);

        $pendaftaran->status = $data['status'];
        $pendaftaran->catatan_seleksi = $data['catatan_seleksi'] ?? null;

        $pendaftaran->tanggal_diumumkan =
            $data['status'] === 'menunggu' ? null : now();

        $pendaftaran->save();

        return redirect()
            ->route('admin.spmb.show', $pendaftaran->id)
            ->with('success', 'Status seleksi berhasil diperbarui.');
    }

    // Menampilkan formulir pendaftaran
    public function index()
    {
        return view('spmb.index');
    }

    // Menyimpan pendaftaran calon murid
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_calon' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'nama_orang_tua' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        do {
            $nomor = 'SPMB-' . date('Y') . '-' . Str::upper(Str::random(6));
        } while (PendaftaranSpmb::where(
            'nomor_pendaftaran',
            $nomor
        )->exists());

        $token = Str::random(64);

        $pendaftaran = PendaftaranSpmb::create(array_merge($data, [
            'nomor_pendaftaran' => $nomor,
            'token_bukti' => $token,
            'status' => 'menunggu',
        ]));

        return redirect()->route('spmb.bukti', [
            'token' => $pendaftaran->token_bukti,
        ])->with('success', 'Pendaftaran berhasil dikirim.');
    }

    // Menampilkan bukti pendaftaran
    public function bukti(string $token)
    {
        $pendaftaran = PendaftaranSpmb::where(
            'token_bukti',
            $token
        )->firstOrFail();

        return view('spmb.bukti', compact('pendaftaran'));
    }

    // Mengecek status pendaftaran menggunakan nomor pendaftaran
    public function cek()
    {
        return view('spmb.cek');
    }

    public function hasil(Request $request)
    {
        $request->validate([
            'nomor_pendaftaran' => 'required|string|max:50',
        ]);

        $pendaftaran = PendaftaranSpmb::where(
            'nomor_pendaftaran',
            $request->nomor_pendaftaran
        )->first();

        if (!$pendaftaran) {
            return back()
                ->withErrors([
                    'nomor_pendaftaran' => 'Nomor pendaftaran tidak ditemukan.',
                ])
                ->withInput();
        }

        return view('spmb.hasil', compact('pendaftaran'));
    }
}
