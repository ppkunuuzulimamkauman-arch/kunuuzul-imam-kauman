<?php

namespace App\Http\Controllers;

use App\Models\PjgtLaporanGt;
use App\Models\Permohonan;
use App\Models\User;
use Illuminate\Http\Request;

class PjgtLaporanController extends Controller
{
    private function tahunAjaran(): string { return \App\Models\Setting::tahunAjaran(); }

    // Sekarang laporan bisa diisi kapan saja (apa aja) — bebas
    private function isAkhirBulan(): bool { return true; }
    private function canIsi(): bool { return true; }
    private function nextWindow(): string { return now()->locale('id')->isoFormat('D MMMM YYYY'); }

    private function gtDiLembaga(User $pjgt)
    {
        // Ambil madrasah PJGT dari permohonan terbaru (bukan ijin)
        $myMadrasah = Permohonan::where('username',$pjgt->username)
            ->where(function($q){ $q->whereNull('extra_answers')->orWhere('extra_answers','not like','%form-ijin-gt%'); })
            ->latest()->value('nama_madrasah');
        // GT di lembaga tersebut: cari via GtBiodata? fallback: semua GT (biasanya 1 GT)
        // Untuk sementara ambil GT yang penugasannya Diterima dan madrasah sama, atau semua GT jika tidak ketemu
        if ($myMadrasah) {
            // Coba match via permohonan yang butuh_gt dan madrasah sama — ambil GT yang tugasnya di madrasah tersebut
            // Simplifikasi: ambil semua GT, PJGT pilih 1
            return User::where('role','gt')->orderBy('name')->get();
        }
        return User::where('role','gt')->orderBy('name')->get();
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $query = PjgtLaporanGt::with(['pjgt','gt'])->latest();
        if ($user->role === 'pjgt') $query->where('pjgt_user_id',$user->id);
        elseif ($user->role === 'gt') $query->where('gt_user_id',$user->id);
        $laporans = $query->paginate(15)->withQueryString();
        $isAkhirBulan = $this->isAkhirBulan();
        $canIsi = $this->canIsi();
        $nextWindow = $this->nextWindow();
        return view('pjgt.laporan-gt', compact('laporans','isAkhirBulan','canIsi','nextWindow'));
    }

    // Export Laporan GT — Excel (.xls), siap cetak.
    // Scope: pjgt = buatannya sendiri, gt = yang ditujukan untuknya, admin = semua.
    public function export(Request $request)
    {
        $user = auth()->user();
        $query = PjgtLaporanGt::with(['pjgt','gt'])->latest();
        if ($user->role === 'pjgt') $query->where('pjgt_user_id',$user->id);
        elseif ($user->role === 'gt') $query->where('gt_user_id',$user->id);
        $data = $query->get();

        $filename = 'Laporan-GT_'.$user->role.'_'.date('Y-m-d_His').'.xls';
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        $callback = function() use ($data) {
            $score = fn($v) => $v === 'Sangat Baik' ? 3 : ($v === 'Baik' ? 2 : ($v === 'Kurang' ? 1 : 0));
            echo "\xEF\xBB\xBF";
            echo "<table border='1'>";
            echo "<tr><th colspan='9' style='background:#0a3d1f;color:#d4af37;text-align:center;font-size:14px'>TMTB & DAI KIK — PP KUNUUZUL IMAM KAUMAN • Laporan Kegiatan GT • Total: ".$data->count()."</th></tr>";
            echo "<tr style='background:#d4af37;color:#0a3d1f;font-weight:bold'><th>No</th><th>Periode</th><th>GT</th><th>PJGT</th><th>Madrasah</th><th>Tahun Ajaran</th><th>Rata-rata</th><th>Status</th><th>Catatan Umum</th></tr>";
            foreach ($data as $i => $l) {
                $vals = collect($l->madrasiyah ?? [])->pluck('nilai')->merge(collect($l->kemasyarakatan ?? [])->pluck('nilai'))->map($score)->filter();
                $avg = $vals->count() ? round($vals->avg(), 1) : '-';
                echo "<tr>";
                echo "<td>".($i + 1)."</td>";
                echo "<td>".htmlspecialchars($l->periode ?? $l->bulan ?? '-')."</td>";
                echo "<td>".htmlspecialchars($l->gt->name ?? '-')."</td>";
                echo "<td>".htmlspecialchars($l->pjgt->name ?? '-')."</td>";
                echo "<td>".htmlspecialchars($l->nama_madrasah ?? '-')."</td>";
                echo "<td>".htmlspecialchars($l->tahun_ajaran ?? '-')."</td>";
                echo "<td>{$avg}</td>";
                echo "<td>".htmlspecialchars($l->status ?? '-')."</td>";
                echo "<td>".htmlspecialchars($l->catatan_umum ?? '-')."</td>";
                echo "</tr>";
            }
            echo "</table>";
        };

        return response()->stream($callback, 200, $headers);
    }

    public function create()
    {
        $user = auth()->user();
        // Bebas isi kapan saja — tanpa batas akhir bulan
        
        $gtList = $this->gtDiLembaga($user);
        $periode = now()->format('Y-m');
        $bulan = now()->locale('id')->isoFormat('MMMM YYYY');
        $tahunAjaran = $this->tahunAjaran();
        // Nama madrasah PJGT
        $namaMadrasah = Permohonan::where('username',$user->username)
            ->where(function($q){ $q->whereNull('extra_answers')->orWhere('extra_answers','not like','%form-ijin-gt%'); })
            ->latest()->value('nama_madrasah') ?? '';
        // Cek apakah sudah isi bulan ini untuk GT tersebut (nanti di store)
        $isAkhirBulan = $this->isAkhirBulan();
        $canIsi = true;
        return view('pjgt.laporan-gt-form', compact('gtList','periode','bulan','tahunAjaran','namaMadrasah','isAkhirBulan','canIsi'));
    }

    public function store(Request $request)
    {
        // Bebas isi apa aja — validasi longgar
        $request->validate([
            'gt_user_id' => 'required|exists:users,id',
            'periode' => 'required|date_format:Y-m',
            'madrasiyah' => 'nullable|array',
            'madrasiyah.*.nilai' => 'nullable|in:Sangat Baik,Baik,Kurang',
            'madrasiyah.*.catatan' => 'nullable|string|max:500',
            'kemasyarakatan' => 'nullable|array',
            'kemasyarakatan.*.nilai' => 'nullable|in:Sangat Baik,Baik,Kurang',
            'kemasyarakatan.*.catatan' => 'nullable|string|max:500',
            'catatan_umum' => 'nullable|string|max:1000',
            'nama_madrasah' => 'nullable|string|max:255',
        ]);
        $pjgt = auth()->user();
        // Pastikan GT valid
        $gt = User::where('id',$request->gt_user_id)->where('role','gt')->firstOrFail();
        // Cegah duplikat periode untuk GT yang sama di lembaga yang sama
        $exists = PjgtLaporanGt::where('pjgt_user_id',$pjgt->id)->where('gt_user_id',$gt->id)->where('periode',$request->periode)->exists();
        if ($exists) {
            return back()->withErrors(['msg' => 'Laporan GT '.$gt->name.' untuk periode '.$request->periode.' sudah diisi. Edit laporan tersebut jika perlu.'])->withInput();
        }
        $namaMadrasah = Permohonan::where('username',$pjgt->username)->latest()->value('nama_madrasah') ?? $request->nama_madrasah ?? '';
        // Susun array madrasiyah/kemasyarakatan sesuai urutan indikator
        $madrasiyah = [];
        foreach (PjgtLaporanGt::MADRASIYAH_INDIKATOR as $no=>$ind) {
            $madrasiyah[$no] = [
                'indikator' => $ind,
                'nilai' => $request->madrasiyah[$no]['nilai'] ?? null,
                'catatan' => $request->madrasiyah[$no]['catatan'] ?? null,
            ];
        }
        $kemasyarakatan = [];
        foreach (PjgtLaporanGt::KEMASYARAKATAN_INDIKATOR as $no=>$ind) {
            $kemasyarakatan[$no] = [
                'indikator' => $ind,
                'nilai' => $request->kemasyarakatan[$no]['nilai'] ?? null,
                'catatan' => $request->kemasyarakatan[$no]['catatan'] ?? null,
            ];
        }
        $laporan = PjgtLaporanGt::create([
            'pjgt_user_id' => $pjgt->id,
            'gt_user_id' => $gt->id,
            'tahun_ajaran' => $this->tahunAjaran(),
            'bulan' => $request->periode,
            'periode' => $request->periode,
            'nama_madrasah' => $namaMadrasah,
            'madrasiyah' => $madrasiyah,
            'kemasyarakatan' => $kemasyarakatan,
            'catatan_umum' => $request->catatan_umum,
            'status' => 'Terkirim',
        ]);
        return redirect()->route('pjgt.laporan.index')->with('success','Laporan kegiatan GT '.$gt->name.' periode '.$request->periode.' berhasil disimpan.');
    }

    public function show(PjgtLaporanGt $laporan)
    {
        $user = auth()->user();
        if ($user->role === 'pjgt' && $laporan->pjgt_user_id !== $user->id) abort(403);
        if ($user->role === 'gt' && $laporan->gt_user_id !== $user->id) abort(403);
        $laporan->load(['pjgt','gt']);
        return view('pjgt.laporan-gt-show', compact('laporan'));
    }

    public function destroy(PjgtLaporanGt $laporan)
    {
        if (auth()->user()->role !== 'admin' && $laporan->pjgt_user_id !== auth()->id()) abort(403);
        $laporan->delete();
        return back()->with('success','Laporan dihapus');
    }
}
