<?php

namespace App\Http\Controllers;

use App\Models\GtAbsensi;
use App\Models\GtBiodata;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GtController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:gt,admin')->except(['pjgtBiodata', 'updatePjgtBiodata', 'rekapAbsensi', 'rekapBiodata', 'showBiodata', 'editBiodata', 'updateBiodataAdmin', 'destroyUser']);
        $this->middleware('role:pjgt,admin')->only(['pjgtBiodata', 'updatePjgtBiodata']);
        $this->middleware('role:admin')->only(['rekapAbsensi', 'rekapBiodata', 'showBiodata', 'editBiodata', 'updateBiodataAdmin', 'destroyUser']);
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
        $serverRiwayat = GtAbsensi::where('user_id', $user->id)
            ->where('jenis', 'mengajar')
            ->orderBy('tanggal', 'desc')
            ->take(14)
            ->get();
        $sudahHariIni = GtAbsensi::where('user_id', $user->id)
            ->where('jenis', 'mengajar')
            ->whereDate('tanggal', now()->toDateString())
            ->first();
        return view('gt.absensi-mengajar', compact('user', 'serverRiwayat', 'sudahHariIni'));
    }

    public function storeAbsensiMengajar(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'status' => 'required|in:Hadir,Izin,Sakit,Libur',
            'keterangan' => 'nullable|string|max:500',
        ]);
        $tanggal = now()->toDateString();
        $exists = GtAbsensi::where('user_id', $user->id)
            ->where('jenis', 'mengajar')
            ->whereDate('tanggal', $tanggal)
            ->exists();
        if ($exists) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Sudah absen hari ini — tidak bisa absen lagi'], 422);
            }
            return back()->withErrors(['msg' => 'Sudah absen hari ini — tidak bisa absen lagi']);
        }
        $absen = GtAbsensi::create([
            'user_id' => $user->id,
            'tanggal' => $tanggal,
            'jenis' => 'mengajar',
            'shalat' => null,
            'status' => $data['status'],
            'keterangan' => $data['keterangan'] ?? null,
            'jam' => now()->format('H:i'),
        ]);
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Absensi mengajar tersimpan', 'data' => $absen]);
        }
        return back()->with('success', 'Absensi mengajar tersimpan dan terkirim ke Admin.');
    }

    public function absensiShalat()
    {
        $user = auth()->user();
        $today = now()->toDateString();
        $serverHariIni = GtAbsensi::where('user_id', $user->id)
            ->where('jenis', 'shalat')
            ->whereDate('tanggal', $today)
            ->orderBy('id')
            ->get();
        $serverRiwayat = GtAbsensi::where('user_id', $user->id)
            ->where('jenis', 'shalat')
            ->orderBy('tanggal', 'desc')
            ->take(70)
            ->get()
            ->groupBy(fn($r) => $r->tanggal->format('Y-m-d'));
        return view('gt.absensi-shalat', compact('user', 'serverHariIni', 'serverRiwayat'));
    }

    public function storeAbsensiShalat(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'shalat' => 'required|in:Subuh,Dzuhur,Ashar,Maghrib,Isya',
            'peran' => 'required|in:Imam,Makmum',
            'cara' => 'required|in:Munfarid,Berjamaah',
            'keterangan' => 'nullable|string|max:500',
        ]);
        $tanggal = now()->toDateString();
        $exists = GtAbsensi::where('user_id', $user->id)
            ->where('jenis', 'shalat')
            ->whereDate('tanggal', $tanggal)
            ->where('shalat', $data['shalat'])
            ->exists();
        if ($exists) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Shalat ' . $data['shalat'] . ' hari ini sudah tercatat'], 422);
            }
            return back()->withErrors(['msg' => 'Shalat ' . $data['shalat'] . ' hari ini sudah tercatat']);
        }
        $absen = GtAbsensi::create([
            'user_id' => $user->id,
            'tanggal' => $tanggal,
            'jenis' => 'shalat',
            'shalat' => $data['shalat'],
            'status' => 'Dicatat',
            'peran' => $data['peran'],
            'cara' => $data['cara'],
            'keterangan' => $data['keterangan'] ?? null,
            'jam' => now()->format('H:i'),
        ]);
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Shalat ' . $data['shalat'] . ' tersimpan', 'data' => $absen]);
        }
        return back()->with('success', 'Shalat ' . $data['shalat'] . ' tersimpan dan terkirim ke Admin.');
    }

    // Rekap Admin — matriks bulanan per GT (baris=tanggal, kolom=kegiatan)
    // GT absen lewat HP → otomatis masuk ke matriks ini
    public function rekapAbsensi(Request $request)
    {
        $bulan = $request->query('bulan', now()->format('Y-m'));
        if (! preg_match('/^\d{4}-\d{2}$/', (string) $bulan)) {
            $bulan = now()->format('Y-m');
        }
        [$thn, $bln] = array_map('intval', explode('-', $bulan));
        $bln = max(1, min(12, $bln));
        $bulan = sprintf('%04d-%02d', $thn, $bln);

        $shalatCols = ['Subuh', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya'];

        $gtUsers = \App\Models\User::where('role', 'gt')->orderBy('name')->get();
        $gtId = (int) $request->query('gt_user_id', optional($gtUsers->first())->id);
        $gt = $gtUsers->firstWhere('id', $gtId);

        $daysInMonth = \Carbon\Carbon::create($thn, $bln, 1)->daysInMonth;
        $monthLabel = \Carbon\Carbon::create($thn, $bln, 1)->locale('id')->isoFormat('MMMM YYYY');

        $byDay = [];
        $totShalat = array_fill_keys($shalatCols, 0);
        $totMengajar = 0;
        $totMunfarid = 0;
        $totBerjamaah = 0;
        $totImam = 0;
        $totMakmum = 0;

        if ($gt) {
            $records = GtAbsensi::where('user_id', $gt->id)
                ->whereYear('tanggal', $thn)
                ->whereMonth('tanggal', $bln)
                ->orderBy('tanggal')
                ->orderBy('id')
                ->get();
            foreach ($records as $r) {
                $day = (int) $r->tanggal->format('j');
                if ($r->jenis === 'mengajar') {
                    if (! isset($byDay[$day]['mengajar'])) {
                        $byDay[$day]['mengajar'] = $r;
                        $totMengajar++;
                    }
                } else {
                    if (! isset($byDay[$day]['shalat'][$r->shalat])) {
                        $byDay[$day]['shalat'][$r->shalat] = $r;
                        if (isset($totShalat[$r->shalat])) {
                            $totShalat[$r->shalat]++;
                        }
                        if ($r->cara === 'Munfarid') {
                            $totMunfarid++;
                        } elseif ($r->cara === 'Berjamaah') {
                            $totBerjamaah++;
                        }
                        if ($r->peran === 'Imam') {
                            $totImam++;
                        } elseif ($r->peran === 'Makmum') {
                            $totMakmum++;
                        }
                    }
                }
            }
        }

        return view('admin.absensi.index', compact(
            'bulan', 'gtUsers', 'gtId', 'gt', 'daysInMonth', 'monthLabel',
            'shalatCols', 'byDay', 'totShalat', 'totMengajar',
            'totMunfarid', 'totBerjamaah', 'totImam', 'totMakmum'
        ));
    }

    // Daftar Biodata GT/PJGT — Admin lihat semua (terpusat)
    public function rekapBiodata(Request $request)
    {
        $role = $request->query('role');
        $search = $request->query('search');
        $query = \App\Models\User::with('biodata')->whereIn('role', ['gt', 'pjgt'])->orderBy('name');
        if (in_array($role, ['gt', 'pjgt'])) {
            $query->where('role', $role);
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }
        $users = $query->paginate(15)->withQueryString();
        $countGt = \App\Models\User::where('role', 'gt')->count();
        $countPjgt = \App\Models\User::where('role', 'pjgt')->count();
        return view('admin.biodata.index', compact('users', 'role', 'search', 'countGt', 'countPjgt'));
    }

    public function showBiodata(\App\Models\User $user)
    {
        if (! in_array($user->role, ['gt', 'pjgt'])) {
            abort(404);
        }
        $user->load('biodata');
        $biodata = $user->biodata;
        $absensiTerakhir = GtAbsensi::where('user_id', $user->id)->orderBy('tanggal', 'desc')->orderBy('id', 'desc')->take(5)->get();
        return view('admin.biodata.show', compact('user', 'biodata', 'absensiTerakhir'));
    }

    // Edit biodata GT/PJGT oleh Admin
    public function editBiodata(\App\Models\User $user)
    {
        if (! in_array($user->role, ['gt', 'pjgt'])) {
            abort(404);
        }
        $user->load('biodata');
        $b = $user->biodata;
        $g = fn($k) => $b->$k ?? '';
        $d = fn($k) => $b->$k ? \Carbon\Carbon::parse($b->$k)->format('Y-m-d') : '';
        $defs = [
            ['name' => 'name', 'label' => 'Nama Lengkap', 'req' => true, 'value' => $user->name],
            ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'req' => true, 'value' => $user->email],
            ['name' => 'tempat_lahir', 'label' => 'Tempat Lahir', 'value' => $g('tempat_lahir')],
            ['name' => 'tanggal_lahir', 'label' => 'Tanggal Lahir', 'type' => 'date', 'value' => $d('tanggal_lahir')],
            ['name' => 'nik', 'label' => 'NIK', 'value' => $g('nik')],
            ['name' => 'telepon', 'label' => 'Telepon', 'value' => $g('telepon')],
            ['name' => 'hp', 'label' => 'HP / WA', 'value' => $g('hp')],
            ['name' => 'alamat', 'label' => 'Alamat', 'type' => 'textarea', 'value' => $g('alamat')],
            ['name' => 'kelurahan', 'label' => 'Kelurahan', 'value' => $g('kelurahan')],
            ['name' => 'kecamatan', 'label' => 'Kecamatan', 'value' => $g('kecamatan')],
            ['name' => 'kode_pos', 'label' => 'Kode Pos', 'value' => $g('kode_pos')],
        ];
        if ($user->role === 'gt') {
            $defs = array_merge($defs, [
                ['name' => 'nisn', 'label' => 'NISN', 'value' => $g('nisn')],
                ['name' => 'kewarganegaraan', 'label' => 'Kewarganegaraan', 'value' => $g('kewarganegaraan')],
                ['name' => 'jenis_kelamin', 'label' => 'Jenis Kelamin', 'value' => $g('jenis_kelamin')],
                ['name' => 'agama', 'label' => 'Agama', 'value' => $g('agama')],
                ['name' => 'rt', 'label' => 'RT', 'value' => $g('rt')],
                ['name' => 'rw', 'label' => 'RW', 'value' => $g('rw')],
                ['name' => 'dusun', 'label' => 'Dusun', 'value' => $g('dusun')],
                ['name' => 'tempat_tinggal', 'label' => 'Tempat Tinggal', 'value' => $g('tempat_tinggal')],
                ['name' => 'transport', 'label' => 'Transport', 'value' => $g('transport')],
                ['name' => 'npwp', 'label' => 'NPWP', 'value' => $g('npwp')],
                ['name' => 'penerima_kps', 'label' => 'Penerima KPS', 'value' => $g('penerima_kps')],
                ['name' => 'nik_ayah', 'label' => 'NIK Ayah', 'value' => $g('nik_ayah')],
                ['name' => 'nama_ayah', 'label' => 'Nama Ayah', 'value' => $g('nama_ayah')],
                ['name' => 'tgl_lahir_ayah', 'label' => 'Tgl Lahir Ayah', 'type' => 'date', 'value' => $d('tgl_lahir_ayah')],
                ['name' => 'pendidikan_ayah', 'label' => 'Pendidikan Ayah', 'value' => $g('pendidikan_ayah')],
                ['name' => 'pekerjaan_ayah', 'label' => 'Pekerjaan Ayah', 'value' => $g('pekerjaan_ayah')],
                ['name' => 'penghasilan_ayah', 'label' => 'Penghasilan Ayah', 'value' => $g('penghasilan_ayah')],
                ['name' => 'nik_ibu', 'label' => 'NIK Ibu', 'value' => $g('nik_ibu')],
                ['name' => 'nama_ibu', 'label' => 'Nama Ibu', 'value' => $g('nama_ibu')],
                ['name' => 'tgl_lahir_ibu', 'label' => 'Tgl Lahir Ibu', 'type' => 'date', 'value' => $d('tgl_lahir_ibu')],
                ['name' => 'pendidikan_ibu', 'label' => 'Pendidikan Ibu', 'value' => $g('pendidikan_ibu')],
                ['name' => 'pekerjaan_ibu', 'label' => 'Pekerjaan Ibu', 'value' => $g('pekerjaan_ibu')],
                ['name' => 'penghasilan_ibu', 'label' => 'Penghasilan Ibu', 'value' => $g('penghasilan_ibu')],
                ['name' => 'kebutuhan_gt', 'label' => 'Kebutuhan Khusus GT', 'value' => $g('kebutuhan_gt')],
                ['name' => 'kebutuhan_ayah', 'label' => 'Kebutuhan Khusus Ayah', 'value' => $g('kebutuhan_ayah')],
                ['name' => 'kebutuhan_ibu', 'label' => 'Kebutuhan Khusus Ibu', 'value' => $g('kebutuhan_ibu')],
            ]);
        }
        return view('admin.biodata.edit', compact('user', 'biodata', 'defs'));
    }

    public function updateBiodataAdmin(Request $request, \App\Models\User $user)
    {
        if (! in_array($user->role, ['gt', 'pjgt'])) {
            abort(404);
        }
        if ($user->role === 'gt') {
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
        } else {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
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
        }
        $user->update(['name' => $validated['name'], 'email' => $validated['email']]);
        $biodata = GtBiodata::firstOrCreate(['user_id' => $user->id]);
        $data = collect($validated)->except(['name', 'email', 'foto'])->toArray();
        if ($request->hasFile('foto')) {
            $data['foto_path'] = $request->file('foto')->store('foto-gt', 'public');
        }
        $biodata->update($data);
        return redirect()->route('biodata.show', $user)->with('success', 'Biodata ' . $user->name . ' berhasil diperbarui.');
    }

    // Hapus akun GT/PJGT beserta biodata & absensi (FK cascade)
    public function destroyUser(\App\Models\User $user)
    {
        if (! in_array($user->role, ['gt', 'pjgt'])) {
            abort(404);
        }
        if ($user->id === auth()->id()) {
            return back()->withErrors(['msg' => 'Tidak bisa menghapus akun sendiri.']);
        }
        $nama = $user->name;
        $user->delete();
        return redirect()->route('biodata.rekap')->with('success', 'Akun ' . $nama . ' beserta biodata & absensinya dihapus.');
    }
}
