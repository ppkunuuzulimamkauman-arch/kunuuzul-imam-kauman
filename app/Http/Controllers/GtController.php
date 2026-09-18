<?php

namespace App\Http\Controllers;

use App\Models\GtBiodata;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GtController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:gt,admin')->except(['pjgtBiodata', 'updatePjgtBiodata']);
        $this->middleware('role:pjgt,admin')->only(['pjgtBiodata', 'updatePjgtBiodata']);
    }

    private function tugasUtama()
    {
        return Permohonan::where('status', 'Diterima')->latest()->first();
    }

    public function biodata()
    {
        $user = auth()->user();
        $tugasUtama = $user->role === 'gt' ? $this->tugasUtama() : null;
        $totalTugas = Permohonan::where('status', 'Diterima')->count();
        $biodata = GtBiodata::firstOrCreate(['user_id' => $user->id]);
        return view('gt.biodata', compact('user', 'tugasUtama', 'totalTugas', 'biodata'));
    }

    public function updateBiodata(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'nik' => 'nullable|string|max:30',
            'nisn' => 'nullable|string|max:30',
            'kewarganegaraan' => 'nullable|string|max:50',
            'jenis_kelamin' => 'nullable|string|max:20',
            'agama' => 'nullable|string|max:30',
            'alamat' => 'nullable|string|max:500',
            'kode_pos' => 'nullable|string|max:10',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'dusun' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'tempat_tinggal' => 'nullable|string|max:50',
            'transport' => 'nullable|string|max:50',
            'telepon' => 'nullable|string|max:20',
            'hp' => 'nullable|string|max:20',
            'npwp' => 'nullable|string|max:30',
            'penerima_kps' => 'nullable|string|max:20',
            'nik_ayah' => 'nullable|string|max:30',
            'nama_ayah' => 'nullable|string|max:100',
            'tgl_lahir_ayah' => 'nullable|date',
            'pendidikan_ayah' => 'nullable|string|max:50',
            'pekerjaan_ayah' => 'nullable|string|max:50',
            'penghasilan_ayah' => 'nullable|string|max:50',
            'nik_ibu' => 'nullable|string|max:30',
            'nama_ibu' => 'nullable|string|max:100',
            'tgl_lahir_ibu' => 'nullable|date',
            'pendidikan_ibu' => 'nullable|string|max:50',
            'pekerjaan_ibu' => 'nullable|string|max:50',
            'penghasilan_ibu' => 'nullable|string|max:50',
            'kebutuhan_gt' => 'nullable|string|max:100',
            'kebutuhan_ayah' => 'nullable|string|max:100',
            'kebutuhan_ibu' => 'nullable|string|max:100',
        ]);

        // Nama & email tersimpan di users → dashboard (auth()->user()->name) ikut terganti otomatis
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $biodata = GtBiodata::firstOrCreate(['user_id' => $user->id]);
        $data = collect($validated)->except(['name', 'email', 'foto'])->toArray();

        if ($request->hasFile('foto')) {
            $data['foto_path'] = $request->file('foto')->store('foto-gt', 'public');
        }

        $biodata->update($data);

        return redirect()->route('gt.biodata')->with('success', 'Biodata berhasil disimpan. Nama di dashboard ikut diperbarui.');
    }

    // === PJGT Biodata — dibedakan dari GT ===
    public function pjgtBiodata()
    {
        $user = auth()->user();
        $tugasUtama = $this->tugasUtama();
        $biodata = GtBiodata::firstOrCreate(['user_id' => $user->id]);
        // Ambil permohonan terbaru milik PJGT untuk info madrasah
        $permohonan = Permohonan::where('username', $user->username)->latest()->first();
        return view('pjgt.biodata', compact('user', 'biodata', 'tugasUtama', 'permohonan'));
    }

    public function updatePjgtBiodata(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', \Illuminate\Validation\Rule::unique('users', 'email')->ignore($user->id)],
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'nik' => 'nullable|string|max:30',
            'telepon' => 'nullable|string|max:20',
            'hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
        ]);
        $user->update(['name' => $validated['name'], 'email' => $validated['email']]);
        $biodata = GtBiodata::firstOrCreate(['user_id' => $user->id]);
        $data = collect($validated)->except(['name', 'email', 'foto'])->toArray();
        if ($request->hasFile('foto')) {
            $data['foto_path'] = $request->file('foto')->store('foto-gt', 'public');
        }
        $biodata->update($data);
        return redirect()->route('pjgt.biodata')->with('success', 'Biodata PJGT berhasil disimpan.');
    }

    public function kegiatan()
    {
        $user = auth()->user();
        $tugas = Permohonan::where('status', 'Diterima')->latest()->paginate(10);
        return view('gt.kegiatan', compact('user', 'tugas'));
    }

    public function absensiMengajar()
    {
        $user = auth()->user();
        return view('gt.absensi-mengajar', compact('user'));
    }

    public function absensiShalat()
    {
        $user = auth()->user();
        return view('gt.absensi-shalat', compact('user'));
    }
}
