<?php

namespace App\Http\Controllers;

use App\Models\JenisBeasiswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranBeasiswaController extends Controller
{
    private const DEFAULT_IPK = 3.40;

    /**
     * Menampilkan daftar jenis beasiswa yang tersedia.
     */
    public function jenisBeasiswa()
    {
        $this->ensureJenisBeasiswa();
        $jenisBeasiswa = JenisBeasiswa::orderBy('minimal_ipk', 'desc')->get();

        return view('jenis_beasiswa', compact('jenisBeasiswa'));
    }

    /**
     * Menampilkan formulir pendaftaran dengan IPK yang sudah dikunci.
     */
    public function create()
    {
        $this->ensureJenisBeasiswa();
        $ipk = $this->generateRandomIpk();
        session(['ipk_value' => $ipk]);
        $jenisBeasiswa = JenisBeasiswa::orderBy('nama')->get();

        return view('form_pendaftaran', compact('ipk', 'jenisBeasiswa'));
    }

    /**
     * Menyimpan data pendaftaran dan berkas ke storage publik.
     */
    public function store(Request $request)
    {
        $ipk = session('ipk_value', self::DEFAULT_IPK);
        $request->merge(['ipk' => $ipk]);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'no_hp' => ['required', 'regex:/^[0-9]+$/'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
            'ipk' => ['required', 'numeric', 'min:0', 'max:4'],
            'jenis_beasiswa_id' => ['nullable', 'exists:jenis_beasiswa,id'],
            'dokumen' => ['nullable', 'file', 'mimes:pdf,jpg,zip', 'max:2048'],
        ]);

        if ($ipk < 3) {
            return back()
                ->withErrors(['ipk' => 'IPK Anda belum memenuhi syarat beasiswa.'])
                ->withInput();
        }

        $filePath = null;
        if ($request->hasFile('dokumen')) {
            $filePath = $request->file('dokumen')->store('berkas', 'public');
        }

        $jenisBeasiswaId = $validated['jenis_beasiswa_id'] ?? null;
        $statusAjuan = 'belum diverifikasi';
        if ($jenisBeasiswaId) {
            $jenisDipilih = JenisBeasiswa::find($jenisBeasiswaId);
            if ($jenisDipilih && $ipk >= $jenisDipilih->minimal_ipk) {
                $statusAjuan = 'terverifikasi';
            }
        }

        Pendaftaran::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'semester' => $validated['semester'],
            'ipk' => $validated['ipk'],
            'jenis_beasiswa_id' => $jenisBeasiswaId,
            'file_path' => $filePath,
            'status_ajuan' => $statusAjuan,
        ]);

        session()->forget('ipk_value');

        return redirect()->route('hasil.pendaftaran')->with('success', 'Pendaftaran berhasil dikirim.');
    }

    /**
     * Menampilkan hasil seluruh pendaftaran.
     */
    public function hasil()
    {
        $this->ensureJenisBeasiswa();
        $pendaftarans = Pendaftaran::with('jenisBeasiswa')->latest()->get();

        return view('hasil_pendaftaran', compact('pendaftarans'));
    }

    /**
     * Membuat default jenis beasiswa jika belum ada di basis data.
     */
    private function ensureJenisBeasiswa(): void
    {
        if (JenisBeasiswa::exists()) {
            return;
        }

        $now = now();
        JenisBeasiswa::insert([
            [
                'nama' => 'Beasiswa Akademik',
                'minimal_ipk' => 3.00,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Beasiswa Non Akademik',
                'minimal_ipk' => 3.00,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Menghasilkan IPK acak antara 2.50 - 4.00.
     */
    private function generateRandomIpk(): float
    {
        return random_int(250, 400) / 100;
    }
}
