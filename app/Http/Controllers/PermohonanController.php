<?php

namespace App\Http\Controllers;

use App\Models\FormQuestion;
use App\Models\Permohonan;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    private function getData()
    {
        return session('permohonan_data', []);
    }

    private function saveData(array $data)
    {
        session(['permohonan_data' => array_merge($this->getData(), $data)]);
    }

    private function getExtra()
    {
        return session('permohonan_extra', []);
    }

    private function saveExtra(array $data)
    {
        session(['permohonan_extra' => array_merge($this->getExtra(), $data)]);
    }

    private function tahunAjaranAktif(): string
    {
        // Terpusat — diubah admin lewat menu Pengaturan (fallback config/.env)
        return \App\Models\Setting::tahunAjaran();
    }

    private function sudahMengajukan(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        if ($user->role === 'admin') return false;
        // Hanya hitung pengajuan FORM PERMOHONAN utama, bukan ijin GT (via form-ijin-gt)
        return Permohonan::where('username', $user->username)
            ->where('tahun', $this->tahunAjaranAktif())
            ->where(function($q){ $q->whereNull('extra_answers')->orWhere('extra_answers','not like','%form-ijin-gt%'); })
            ->exists();
    }

    private function getPermohonanAktif(): ?Permohonan
    {
        $user = auth()->user();
        if (!$user || $user->role === 'admin') return null;
        return Permohonan::where('username', $user->username)
            ->where('tahun', $this->tahunAjaranAktif())
            ->where(function($q){ $q->whereNull('extra_answers')->orWhere('extra_answers','not like','%form-ijin-gt%'); })
            ->latest()->first();
    }

    private function redirectJikaSudahMengajukan()
    {
        // Hanya untuk cegah pembuatan BARU (storeStep4/storeIjin). Form tetap boleh dilihat untuk edit.
        if ($this->sudahMengajukan()) {
            return redirect()->route('permohonan.lama')
                ->withErrors(['msg' => 'Anda sudah mengajukan untuk tahun '.$this->tahunAjaranAktif().'. Tidak bisa membuat pengajuan baru — silakan buka form untuk melihat & edit pengajuan tahun ini.']);
        }
        return null;
    }

    private function customQuestions(int $step)
    {
        return FormQuestion::where('step',$step)->where('is_active',true)->orderBy('sort_order')->orderBy('id')->get();
    }

    private function customRules(int $step): array
    {
        $rules = [];
        foreach ($this->customQuestions($step) as $q) {
            $key = 'extra.'.$q->field_name;
            if ($q->is_required) {
                $rules[$key] = 'required|string|max:2000';
            } else {
                $rules[$key] = 'nullable|string|max:2000';
            }
            if ($q->field_type === 'number') $rules[$key] .= '|numeric';
            if ($q->field_type === 'date') $rules[$key] = ($q->is_required ? 'required' : 'nullable').'|date';
        }
        return $rules;
    }

    // STEP 1 : Identitas Madrasah (halaman 1 PDF)
    public function step1()
    {
        $existing = $this->getPermohonanAktif();
        $sudahAjukan = $existing !== null;
        $sessionData = $this->getData();
        // Jika sudah ada pengajuan tahun ini dan belum ada session wizard, tampilkan data DB agar bisa dikoreksi/edit
        if ($sudahAjukan && empty($sessionData)) {
            $data = $existing->toArray();
            // preload juga extra_answers ke session extra agar custom fields terisi
            if (!empty($existing->extra_answers) && empty($this->getExtra())) {
                session(['permohonan_extra' => $existing->extra_answers]);
            }
        } else {
            $data = $sessionData;
        }
        // default values - PP KUNUUZUL IMAM KAUMAN
        $defaults = [
            'nama_madrasah' => $data['nama_madrasah'] ?? 'PP KUNUUZUL IMAM KAUMAN',
            'nama_pesantren' => $data['nama_pesantren'] ?? 'PP KUNUUZUL IMAM KAUMAN',
            'negara' => $data['negara'] ?? 'INDONESIA',
            'provinsi' => $data['provinsi'] ?? 'JAWA TIMUR',
            'kabupaten' => $data['kabupaten'] ?? 'KABUPATEN BONDOWOSO',
            'kecamatan' => $data['kecamatan'] ?? 'BONDOWOSO',
            'desa' => $data['desa'] ?? 'KAUMAN',
            'jalan_dusun' => $data['jalan_dusun'] ?? 'JLN KH ZAINUL ARIFIN NO. 165',
            'kode_pos' => $data['kode_pos'] ?? '68213',
            'rt' => $data['rt'] ?? '01',
            'rw' => $data['rw'] ?? '02',
            'telepon' => $data['telepon'] ?? '085236680680',
            'email' => $data['email'] ?? 'kunuzulimam@gmail.com',
        ];
        $customQuestions = $this->customQuestions(1);
        $extraData = $this->getExtra();
        return view('permohonan.step1', compact('defaults', 'data', 'customQuestions', 'extraData', 'existing', 'sudahAjukan'));
    }

    public function storeStep1(Request $request)
    {
        // Step 1-3 tetap boleh disimpan ke session untuk flow edit — hanya final store yang dicegah duplikat
        
        $validated = $request->validate(array_merge([
            'nama_madrasah' => 'required|string|max:255',
            'nama_pesantren' => 'required|string|max:255',
            'negara' => 'required|string',
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'jalan_dusun' => 'required|string',
            'kode_pos' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|email',
        ], $this->customRules(1)), [
            'nama_pesantren.required' => 'Nama Pondok Pesantren wajib diisi (sesuai tutorial: jika tidak ada kasih 0 atau -)',
        ]);

        $extra = $validated['extra'] ?? [];
        unset($validated['extra']);
        $this->saveData($validated);
        $this->saveExtra($extra);
        return redirect()->route('permohonan.step2');
    }

    // STEP 2 : Data Pengelola Lembaga (halaman 2)
    public function step2()
    {
        $existing = $this->getPermohonanAktif();
        $sudahAjukan = $existing !== null;
        $sessionData = $this->getData();
        if ($sudahAjukan && empty($sessionData)) {
            $data = $existing->toArray();
        } else {
            $data = $sessionData;
        }
        $customQuestions = $this->customQuestions(2);
        $extraData = $this->getExtra();
        return view('permohonan.step2', compact('data', 'customQuestions', 'extraData', 'existing', 'sudahAjukan'));
    }

    public function storeStep2(Request $request)
    {
        
        $validated = $request->validate(array_merge([
            'pengasuh' => 'required|string|min:3|max:100',
            'ketua_yayasan' => 'required|string|min:3|max:100',
            'sekretaris_yayasan' => 'required|string|min:3|max:100',
            'kepala_madrasah' => 'required|string|min:3|max:100',
            'pjgt' => 'required|string|min:3|max:100',
            'pjgt_hp' => 'required|string|regex:/^08[0-9]{8,13}$/',
        ], $this->customRules(2)), [
            'pengasuh.required' => 'Pengasuh wajib diisi (jika tidak ada isi 0)',
            'sekretaris_yayasan.required' => 'Sekretaris Yayasan wajib diisi (jika tidak ada isi 0)',
            'pjgt_hp.regex' => 'No HP/WA PJGT harus format 08... 10-15 digit',
        ]);

        $extra = $validated['extra'] ?? [];
        unset($validated['extra']);
        $this->saveData($validated);
        $this->saveExtra($extra);
        return redirect()->route('permohonan.step3');
    }

    // STEP 3 : Situasi dan Kondisi Madrasah (halaman 3)
    public function step3()
    {
        $existing = $this->getPermohonanAktif();
        $sudahAjukan = $existing !== null;
        $sessionData = $this->getData();
        if ($sudahAjukan && empty($sessionData)) {
            $data = $existing->toArray();
        } else {
            $data = $sessionData;
        }
        $defaults = [
            'situasi_madrasah' => $data['situasi_madrasah'] ?? 'PESANTREN',
            'komunikasi_bahasa' => $data['komunikasi_bahasa'] ?? 'INDONESIA',
            'kbm_bahasa' => $data['kbm_bahasa'] ?? 'INDONESIA',
        ];
        $customQuestions = $this->customQuestions(3);
        $extraData = $this->getExtra();
        return view('permohonan.step3', compact('data', 'defaults', 'customQuestions', 'extraData', 'existing', 'sudahAjukan'));
    }

    public function storeStep3(Request $request)
    {
        
        $validated = $request->validate(array_merge([
            'situasi_madrasah' => 'required|in:PESANTREN,MADRASAH',
            'komunikasi_bahasa' => 'required|in:INDONESIA,MADURA,JAWA',
            'mapel_aqidah' => 'required|string',
            'mapel_fiqh' => 'required|string',
            'mapel_ilmu_alat' => 'required|string',
            'mapel_quran' => 'required|string',
            'mapel_akhlaq' => 'required|string',
            'kbm_bahasa' => 'required|in:INDONESIA,MADURA,JAWA',
            'guru_laki' => 'required|string',
            'guru_perempuan' => 'required|string',
        ], $this->customRules(3)));

        $extra = $validated['extra'] ?? [];
        unset($validated['extra']);
        $this->saveData($validated);
        $this->saveExtra($extra);
        return redirect()->route('permohonan.step4');
    }

    // STEP 4 : Jumlah Murid (halaman 4)
    public function step4()
    {
        $existing = $this->getPermohonanAktif();
        $sudahAjukan = $existing !== null;
        $sessionData = $this->getData();
        if ($sudahAjukan && empty($sessionData)) {
            $data = $existing->toArray();
        } else {
            $data = $sessionData;
        }
        $customQuestions = $this->customQuestions(4);
        $extraData = $this->getExtra();
        return view('permohonan.step4', compact('data', 'customQuestions', 'extraData', 'existing', 'sudahAjukan'));
    }

    public function storeStep4(Request $request)
    {
        // Jika sudah ada pengajuan tahun ini, jangan buat baru — update yang ada (mode edit via wizard)
        $existing = $this->getPermohonanAktif();
        $sudahAjukan = $existing !== null;
        
        $validated = $request->validate(array_merge([
            'sifir_putra' => 'nullable|integer|min:0',
            'sifir_putri' => 'nullable|integer|min:0',
            'ibtidaiyah_1_putra' => 'nullable|integer|min:0',
            'ibtidaiyah_1_putri' => 'nullable|integer|min:0',
            'ibtidaiyah_2_putra' => 'nullable|integer|min:0',
            'ibtidaiyah_2_putri' => 'nullable|integer|min:0',
            'ibtidaiyah_3_putra' => 'nullable|integer|min:0',
            'ibtidaiyah_3_putri' => 'nullable|integer|min:0',
            'ibtidaiyah_4_putra' => 'nullable|integer|min:0',
            'ibtidaiyah_4_putri' => 'nullable|integer|min:0',
            'ibtidaiyah_5_putra' => 'nullable|integer|min:0',
            'ibtidaiyah_5_putri' => 'nullable|integer|min:0',
            'ibtidaiyah_6_putra' => 'nullable|integer|min:0',
            'ibtidaiyah_6_putri' => 'nullable|integer|min:0',
            'tsanawiyah_1_putra' => 'nullable|integer|min:0',
            'tsanawiyah_1_putri' => 'nullable|integer|min:0',
            'tsanawiyah_2_putra' => 'nullable|integer|min:0',
            'tsanawiyah_2_putri' => 'nullable|integer|min:0',
            'tsanawiyah_3_putra' => 'nullable|integer|min:0',
            'tsanawiyah_3_putri' => 'nullable|integer|min:0',
            'mukim_putra' => 'nullable|integer|min:0',
            'mukim_putri' => 'nullable|integer|min:0',
            'tidak_mukim_putra' => 'nullable|integer|min:0',
            'tidak_mukim_putri' => 'nullable|integer|min:0',
        ], $this->customRules(4)));

        $extra4 = $validated['extra'] ?? [];
        unset($validated['extra']);
        $this->saveData($validated);
        $this->saveExtra($extra4);

        // Simpan ke DB dan redirect ke rekap / permohnan lama
        $all = $this->getData();

        // Generate alamat lengkap
        $alamat = trim(($all['jalan_dusun'] ?? '') . ' - ' . ($all['desa'] ?? '') . ' - ' . ($all['kecamatan'] ?? '') . ' - ' . ($all['kabupaten'] ?? '') . ' - ' . ($all['provinsi'] ?? ''));

        if ($sudahAjukan && $existing) {
            // MODE EDIT: sudah ada pengajuan tahun ini — update, jangan buat baru
            $existing->update(array_merge($all, [
                'alamat_lengkap' => $alamat,
                'extra_answers' => $this->getExtra() ?: $existing->extra_answers,
                // pjgt_id/tahun/username tidak diubah agar tetap 1 per tahun
            ]));
            session()->forget('permohonan_data');
            session()->forget('permohonan_extra');
            return redirect()->route('permohonan.lama')->with('success', 'Pengajuan tahun '.$this->tahunAjaranAktif().' diperbarui (ID '.$existing->pjgt_id.'). Tidak membuat pengajuan baru.');
        }

        // MODE BARU: belum ada — buat baru
        $maxId = Permohonan::max(\DB::raw('CAST(pjgt_id AS UNSIGNED)'));
        $next = $maxId ? $maxId + 1 : 196;
        if ($next < 195) $next = 195;
        $pjgtId = str_pad($next, 5, '0', STR_PAD_LEFT);
        $pjgtNama = $all['pjgt'] ?? $all['pengasuh'] ?? 'TAUFIQUR ROHMAN';

        $permohonan = Permohonan::create(array_merge($all, [
            'pjgt_id' => $pjgtId,
            'pjgt_nama' => $pjgtNama,
            'alamat_lengkap' => $alamat,
            'wil' => 'T-4',
            'tahun' => $this->tahunAjaranAktif(),
            'status' => 'Proses',
            'butuh_gt' => 1,
            'rapot' => 'A',
            'username' => auth()->user()->username ?? '00007',
            'extra_answers' => $this->getExtra() ?: null,
        ]));

        // clear session
        session()->forget('permohonan_data');
        session()->forget('permohonan_extra');
        session()->flash('success', 'Permohonan berhasil disimpan dengan ID PJGT ' . $pjgtId);

        return redirect()->route('permohonan.lama');
    }

    // FORM IJIN GT — diajukan GT ke Admin
    public function ijinForm()
    {
        $existing = $this->getPermohonanAktif();
        $sudahAjukan = $existing !== null;
        $isApprover = (auth()->user()->role ?? '') === 'admin';
        $customQuestions = $this->customQuestions(5);
        $extraData = [];
        return view('permohonan.ijin', compact('customQuestions', 'extraData', 'existing', 'sudahAjukan', 'isApprover'));
    }

    public function storeIjin(Request $request)
    {
        // Ijin tidak boleh membuat duplikat tahun ini — arahkan edit pengajuan utama
        if ($this->sudahMengajukan()) {
            return redirect()->route('permohonan.lama')->withErrors(['msg' => 'Anda sudah punya pengajuan untuk tahun '.$this->tahunAjaranAktif().'. Form Ijin tidak bisa membuat pengajuan baru — silakan edit pengajuan utama via Form Permohonan (data tetap tampil untuk koreksi).']);
        }
        $validated = $request->validate(array_merge([
            'pjgt_nama' => 'required|string|min:3|max:100',
            'nama_madrasah' => 'nullable|string|max:255',
            'telepon' => 'required|string|min:9|max:20',
            'butuh_gt' => 'nullable|integer|min:1|max:10',
            'tanggal_ijin' => 'required|date',
            'tanggal_sampai' => 'required|date|after_or_equal:tanggal_ijin',
            'keterangan' => 'nullable|string|max:1000',
        ], $this->customRules(5)), [
            'tanggal_sampai.after_or_equal' => 'Tanggal Sampai Dengan harus sama atau setelah Tanggal Mulai Izin.',
        ]);

        $maxId = Permohonan::max(\DB::raw('CAST(pjgt_id AS UNSIGNED)'));
        $next = $maxId ? $maxId + 1 : 196;
        if ($next < 195) $next = 195;
        $pjgtId = str_pad($next, 5, '0', STR_PAD_LEFT);

        Permohonan::create([
            'pjgt_id' => $pjgtId,
            'pjgt_nama' => $validated['pjgt_nama'],
            'pjgt' => $validated['pjgt_nama'],
            'nama_madrasah' => $validated['nama_madrasah'] ?? Permohonan::where('username', auth()->user()->username)->latest()->value('nama_madrasah') ?? '-',
            'telepon' => $validated['telepon'],
            'butuh_gt' => $validated['butuh_gt'] ?? 1,
            'wil' => 'T-4',
            'tahun' => $this->tahunAjaranAktif(),
            'status' => 'Proses',
            'rapot' => 'A',
            'username' => auth()->user()->username ?? '00007',
            'extra_answers' => array_merge(['tanggal_ijin' => $validated['tanggal_ijin'], 'tanggal_sampai' => $validated['tanggal_sampai'], 'keterangan' => $validated['keterangan'] ?? null, 'via' => 'form-ijin-gt'], $validated['extra'] ?? []),
        ]);

        return redirect()->route('permohonan.lama')->with('success', 'Ijin GT berhasil disimpan dengan ID PJGT ' . $pjgtId);
    }

    // Halaman Permohonan Lama — Arsip & Persetujuan Ijin GT (via=ijin)
    public function lama(Request $request)
    {
        $search = $request->query('search');
        $rapot = $request->query('rapot');
        $status = $request->query('status');
        $via = $request->query('via');
        $query = Permohonan::query()->latest();
        if ($via === 'ijin') {
            $query->where('extra_answers', 'like', '%"via":"form-ijin-gt"%');
            // Persetujuan: hanya GT yang ditugaskan di lembaganya (biasanya 1 GT)
            if (auth()->user()->role === 'pjgt') {
                $myMadrasah = Permohonan::where('username', auth()->user()->username)
                    ->where(function($q){ $q->whereNull('extra_answers')->orWhere('extra_answers','not like','%form-ijin-gt%'); })
                    ->latest()->value('nama_madrasah');
                if ($myMadrasah) {
                    $query->where('nama_madrasah', $myMadrasah);
                } else {
                    $query->whereRaw('1=0');
                }
            } elseif (auth()->user()->role === 'gt') {
                $query->where('username', auth()->user()->username);
            }
            // admin lihat semua ijin
        } else {
            // Arsip biasa: admin semua, pjgt/gt milik sendiri
            if (auth()->user()->role === 'pjgt' || auth()->user()->role === 'gt') {
                $query->where('username', auth()->user()->username);
            }
            if ($search) {
                $query->where(function($q) use ($search){
                    $q->where('pjgt_nama','like',"%$search%")
                      ->orWhere('nama_madrasah','like',"%$search%")
                      ->orWhere('pjgt_id','like',"%$search%");
                });
            }
            if ($rapot && in_array($rapot, ['A','B','C'])) {
                $query->where('rapot', $rapot);
            }
            if ($status && in_array($status, ['Diterima','Ditolak','Proses'])) {
                $query->where('status', $status);
            }
        }
        // Untuk persetujuan (via=ijin) gausah filter cari/rapot/status — langsung tampilkan 1 GT di lembaganya
        $permohonans = $query->paginate($via === 'ijin' ? 10 : 15)->withQueryString();

        return view('permohonan.lama', compact('permohonans','search','rapot','status','via'));
    }

    public function show(Permohonan $permohonan)
    {
        $user = auth()->user();
        if ($user->role !== 'admin') {
            $isOwner = $permohonan->username === $user->username;
            // GT boleh lihat tugas penempatan (status Diterima) walau bukan miliknya
            $isTugasGt = $user->role === 'gt' && $permohonan->status === 'Diterima';
            if (!$isOwner && !$isTugasGt) {
                abort(403);
            }
        }
        return view('permohonan.show', compact('permohonan'));
    }

    public function edit(Permohonan $permohonan)
    {
        if (auth()->user()->role !== 'admin' && $permohonan->username !== auth()->user()->username) {
            abort(403);
        }
        return view('permohonan.edit', compact('permohonan'));
    }

    public function update(Request $request, Permohonan $permohonan)
    {
        if (auth()->user()->role !== 'admin' && $permohonan->username !== auth()->user()->username) {
            abort(403);
        }
        $validated = $request->validate([
            'nama_madrasah' => 'required|string|max:255',
            'nama_pesantren' => 'required|string|max:255',
            'telepon' => 'required|string',
            'email' => 'required|email',
            'pjgt_nama' => 'required|string|max:100',
            'status' => 'required|in:Diterima,Ditolak,Proses',
            'rapot' => 'required|in:A,B,C',
            'butuh_gt' => 'required|integer|min:1|max:10',
            'catatan_admin' => 'nullable|string|max:500',
        ]);
        $permohonan->update($validated);
        return redirect()->route('permohonan.lama')->with('success','Permohonan '.$permohonan->pjgt_id.' berhasil diupdate');
    }

    public function approve(Request $request, Permohonan $permohonan)
    {
        $request->validate(['status'=>'required|in:Diterima,Ditolak,Proses','catatan_admin'=>'nullable|string|max:500']);
        $permohonan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'approved_by' => auth()->user()->name,
            'approved_at' => now(),
        ]);
        return back()->with('success','Status '.$permohonan->pjgt_id.' diubah ke '.$request->status);
    }

    public function uploadDokumen(Request $request, Permohonan $permohonan)
    {
        if (auth()->user()->role !== 'admin' && $permohonan->username !== auth()->user()->username) abort(403);
        $request->validate(['dokumen'=>'required|file|mimes:pdf,jpg,png|max:2048']);
        $path = $request->file('dokumen')->store('dokumen','public');
        $permohonan->update(['dokumen_path'=>$path]);
        return back()->with('success','Dokumen berhasil diupload');
    }

    public function destroy(Permohonan $permohonan)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        $permohonan->delete();
        return back()->with('success','Data dihapus');
    }

    public function rekap()
    {
        // Scope sama dengan export/arsip: pjgt milik sendiri, gt hanya Diterima, admin semua
        $base = Permohonan::query();
        if (auth()->user()->role === 'pjgt') {
            $base->where('username', auth()->user()->username);
        } elseif (auth()->user()->role === 'gt') {
            $base->where('status', 'Diterima');
        }
        $total = (clone $base)->count();
        $byStatus = (clone $base)->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total','status');
        $byRapot = (clone $base)->selectRaw('rapot, count(*) as total')->groupBy('rapot')->pluck('total','rapot');
        $byWil = (clone $base)->selectRaw('wil, count(*) as total')->groupBy('wil')->pluck('total','wil');
        $recent = (clone $base)->latest()->take(5)->get();
        return view('permohonan.rekap', compact('total','byStatus','byRapot','byWil','recent'));
    }

    public function laporan(Request $request)
    {
        // Laporan sekarang bebas diisi kapan saja (apa aja) — tanpa batas akhir bulan
        $now = now();
        $isAkhirBulan = true;
        $canIsi = true;
        $nextWindow = $now->locale('id')->isoFormat('D MMMM YYYY');

        $tahun = $request->query('tahun');
        $status = $request->query('status');
        $wil = $request->query('wil');
        $search = $request->query('search');

        $query = Permohonan::query();
        // PJGT hanya lihat milik sendiri
        if (auth()->user()->role === 'pjgt') $query->where('username', auth()->user()->username);
        if ($tahun) $query->where('tahun', $tahun);
        if ($status && in_array($status, ['Diterima','Ditolak','Proses'])) $query->where('status', $status);
        if ($wil) $query->where('wil', $wil);
        if ($search) {
            $query->where(function($q) use ($search){
                $q->where('pjgt_nama','like',"%$search%")
                  ->orWhere('nama_madrasah','like',"%$search%")
                  ->orWhere('pjgt_id','like',"%$search%");
            });
        }

        $total = (clone $query)->count();
        $byStatus = (clone $query)->selectRaw('status, count(*) as c')->groupBy('status')->pluck('c','status');
        $byWil = (clone $query)->selectRaw('wil, count(*) as c')->groupBy('wil')->pluck('c','wil');
        $byProv = (clone $query)->selectRaw('provinsi, count(*) as c')->groupBy('provinsi')->orderByDesc('c')->limit(5)->pluck('c','provinsi');
        $byRapot = (clone $query)->selectRaw('rapot, count(*) as c')->groupBy('rapot')->pluck('c','rapot');
        $list = $query->latest()->paginate(20)->withQueryString();

        $tahunList = Permohonan::select('tahun')->distinct()->pluck('tahun');
        $wilList = Permohonan::select('wil')->distinct()->pluck('wil');

        return view('permohonan.laporan', compact('total','byStatus','byWil','byProv','byRapot','list','tahun','status','wil','search','tahunList','wilList','isAkhirBulan','canIsi','nextWindow'));
    }

    public function export(Request $request)
    {
        $search = $request->query('search');
        $rapot = $request->query('rapot');
        $status = $request->query('status');
        $tahun = $request->query('tahun');
        $wil = $request->query('wil');
        $query = Permohonan::query()->latest();
        // Role filter samakan dengan halaman Arsip: pjgt milik sendiri, gt hanya Diterima
        if (auth()->user()->role === 'pjgt') {
            $query->where('username', auth()->user()->username);
        } elseif (auth()->user()->role === 'gt') {
            $query->where('status', 'Diterima');
        }
        if ($search) {
            $query->where(function($q) use ($search){
                $q->where('pjgt_nama','like',"%$search%")
                  ->orWhere('nama_madrasah','like',"%$search%")
                  ->orWhere('pjgt_id','like',"%$search%");
            });
        }
        if ($rapot && in_array($rapot, ['A','B','C'])) {
            $query->where('rapot', $rapot);
        }
        if ($status && in_array($status, ['Diterima','Ditolak','Proses'])) {
            $query->where('status', $status);
        }
        if ($tahun) {
            $query->where('tahun', $tahun);
        }
        if ($wil) {
            $query->where('wil', $wil);
        }
        $data = $query->get();

        $filterSuffix = ($search?'_search-'.$search:'').($rapot?'_rapot-'.$rapot:'').($status?'_status-'.$status:'').($tahun?'_tahun-'.$tahun:'').($wil?'_wil-'.$wil:'');
        $filename = 'Rekap_TMTB-DAI-KIK_PP-KUNUUZUL'.$filterSuffix.'_'.date('Y-m-d_His').'.xls';
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        $columns = ['ID PJGT','Nama PJGT','Madrasah','Pesantren','Alamat','Desa','Kec','Kab','Prov','Wil','Tahun','Status','Butuh GT','Rapot','Sifir L/P','Ibtidaiyah 1 L/P','Ibtidaiyah 6 L/P','Tsanawiyah 3 L/P','Mukim L/P','Tidak Mukim L/P',' Telepon','Email','Guru L/P'];

        $callback = function() use ($data, $columns, $search, $rapot, $status, $tahun, $wil) {
            echo "\xEF\xBB\xBF";
            echo "<table border='1'>";
            echo "<tr><th colspan='23' style='background:#0a3d1f;color:#d4af37;text-align:center;font-size:14px'>TMTB & DAI KIK — PP KUNUUZUL IMAM KAUMAN • Rekap Permohonan Guru Tugas 1448/1449 H • heritage</th></tr>";
            $filterText = "Filter: ".($search?"search=$search ":"").($rapot?"rapot=$rapot ":"").($status?"status=$status ":"").($tahun?"tahun=$tahun ":"").($wil?"wil=$wil ":"").($search||$rapot||$status||$tahun||$wil?"• ":"Tidak ada filter • ");
            echo "<tr><th colspan='23' style='background:#fdf6e3;color:#0a3d1f;text-align:center'>Jln KH Zainul Arifin No.165 Kauman Bondowoso 68213 • ".$filterText."Export: ".date('d-m-Y H:i')." • Total: ".$data->count()."</th></tr>";
            echo "<tr style='background:#fdf0c7;color:#0a3d1f;font-weight:bold'>";
            foreach($columns as $c){ echo "<th style='background:#d4af37;color:#0a3d1f;border:1px solid #0a3d1f;padding:6px'>".htmlspecialchars($c)."</th>"; }
            echo "</tr>";
            foreach($data as $p){
                echo "<tr>";
                echo "<td>".htmlspecialchars($p->pjgt_id)."</td>";
                echo "<td>".htmlspecialchars($p->pjgt_nama)."</td>";
                echo "<td>".htmlspecialchars($p->nama_madrasah)."</td>";
                echo "<td>".htmlspecialchars($p->nama_pesantren)."</td>";
                echo "<td>".htmlspecialchars($p->alamat_lengkap)."</td>";
                echo "<td>".htmlspecialchars($p->desa)."</td>";
                echo "<td>".htmlspecialchars($p->kecamatan)."</td>";
                echo "<td>".htmlspecialchars($p->kabupaten)."</td>";
                echo "<td>".htmlspecialchars($p->provinsi)."</td>";
                echo "<td>".htmlspecialchars($p->wil)."</td>";
                echo "<td>".htmlspecialchars($p->tahun)."</td>";
                echo "<td>".htmlspecialchars($p->status)."</td>";
                echo "<td>".htmlspecialchars($p->butuh_gt)."</td>";
                echo "<td>".htmlspecialchars($p->rapot)."</td>";
                echo "<td>".$p->sifir_putra."/".$p->sifir_putri."</td>";
                echo "<td>".$p->ibtidaiyah_1_putra."/".$p->ibtidaiyah_1_putri."</td>";
                echo "<td>".$p->ibtidaiyah_6_putra."/".$p->ibtidaiyah_6_putri."</td>";
                echo "<td>".$p->tsanawiyah_3_putra."/".$p->tsanawiyah_3_putri."</td>";
                echo "<td>".$p->mukim_putra."/".$p->mukim_putri."</td>";
                echo "<td>".$p->tidak_mukim_putra."/".$p->tidak_mukim_putri."</td>";
                echo "<td>".htmlspecialchars($p->telepon)."</td>";
                echo "<td>".htmlspecialchars($p->email)."</td>";
                echo "<td>".htmlspecialchars($p->guru_laki)."/".htmlspecialchars($p->guru_perempuan)."</td>";
                echo "</tr>";
            }
            echo "</table>";
        };

        return response()->stream($callback, 200, $headers);
    }
}
