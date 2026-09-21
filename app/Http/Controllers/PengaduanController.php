<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Permohonan;
use App\Models\User;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Pengaduan::with(['pjgt','gt'])->latest();
        if ($user->role === 'gt') {
            // GT melihat pengaduan yang dia buat sendiri (diisi GT apa yang dialami untuk admin)
            $query->where('pjgt_user_id', $user->id);
        } elseif ($user->role === 'pjgt') {
            // PJGT hanya melihat pengaduan buatannya sendiri (bukan dari GT)
            $query->where('pjgt_user_id', $user->id);
        }
        // admin lihat semua — rekap status sesuai scope role (reorder: hilangkan ORDER BY latest agar lolos ONLY_FULL_GROUP_BY)
        $byStatus = (clone $query)->reorder()->selectRaw('status, count(*) as c')->groupBy('status')->pluck('c','status');
        $total = (clone $query)->count();

        $status = $request->query('status');
        $search = $request->query('search');
        $sumber = $request->query('sumber');
        if ($status && in_array($status, Pengaduan::STATUS)) {
            $query->where('status', $status);
        }
        if ($sumber === 'gt') {
            $query->whereColumn('pjgt_user_id', 'gt_user_id');
        } elseif ($sumber === 'pjgt') {
            $query->where(function ($q) {
                $q->whereNull('gt_user_id')->orWhereColumn('pjgt_user_id', '!=', 'gt_user_id');
            });
        }
        if ($search) {
            $query->where(function($q) use ($search){
                $q->where('judul','like',"%{$search}%")
                    ->orWhere('nama_madrasah','like',"%{$search}%")
                    ->orWhere('nama_terlapor','like',"%{$search}%")
                    ->orWhere('kategori','like',"%{$search}%");
            });
        }
        $pengaduans = $query->paginate(15)->withQueryString();
        return view('pengaduan.index', compact('pengaduans','byStatus','total','status','search','sumber'));
    }

    // Export Pengaduan — Excel (.xls), siap cetak.
    // Scope: pjgt/gt = buatannya sendiri, admin = semua. Filter status/sumber/cari dihormati.
    public function export(Request $request)
    {
        $user = auth()->user();
        $query = Pengaduan::with(['pjgt','gt'])->latest();
        if (in_array($user->role, ['pjgt', 'gt'])) {
            $query->where('pjgt_user_id', $user->id);
        }
        $status = $request->query('status');
        $search = $request->query('search');
        $sumber = $request->query('sumber');
        if ($status && in_array($status, Pengaduan::STATUS)) {
            $query->where('status', $status);
        }
        if ($sumber === 'gt') {
            $query->whereColumn('pjgt_user_id', 'gt_user_id');
        } elseif ($sumber === 'pjgt') {
            $query->where(function ($q) {
                $q->whereNull('gt_user_id')->orWhereColumn('pjgt_user_id', '!=', 'gt_user_id');
            });
        }
        if ($search) {
            $query->where(function($q) use ($search){
                $q->where('judul','like',"%{$search}%")
                    ->orWhere('nama_madrasah','like',"%{$search}%")
                    ->orWhere('nama_terlapor','like',"%{$search}%")
                    ->orWhere('kategori','like',"%{$search}%");
            });
        }
        $data = $query->get();

        $filename = 'Pengaduan-GT_'.$user->role.'_'.date('Y-m-d_His').'.xls';
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        $callback = function() use ($data) {
            echo "\xEF\xBB\xBF";
            echo "<table border='1'>";
            echo "<tr><th colspan='9' style='background:#7a0a0a;color:#fff;text-align:center;font-size:14px'>TMTB & DAI KIK — PP KUNUUZUL IMAM KAUMAN • Pengaduan GT • Total: ".$data->count()."</th></tr>";
            echo "<tr style='background:#d4af37;color:#0a3d1f;font-weight:bold'><th>No</th><th>Judul</th><th>Pelapor</th><th>Terlapor</th><th>Madrasah</th><th>Jenis</th><th>Tgl Kejadian</th><th>Status</th><th>Tanggapan Admin</th></tr>";
            foreach ($data as $i => $p) {
                echo "<tr>";
                echo "<td>".($i + 1)."</td>";
                echo "<td>".htmlspecialchars($p->judul ?? '-')."</td>";
                echo "<td>".htmlspecialchars($p->nama_pelapor ?? $p->pjgt->name ?? '-')."</td>";
                echo "<td>".htmlspecialchars($p->nama_terlapor ?? $p->gt->name ?? '-')."</td>";
                echo "<td>".htmlspecialchars($p->nama_madrasah ?? '-')."</td>";
                echo "<td>".htmlspecialchars($p->jenis_pelanggaran ?? $p->kategori ?? '-')."</td>";
                echo "<td>".htmlspecialchars($p->tanggal_kejadian ? $p->tanggal_kejadian->format('d-m-Y') : '-')."</td>";
                echo "<td>".htmlspecialchars($p->status ?? '-')."</td>";
                echo "<td>".htmlspecialchars($p->tanggapan_admin ?? '-')."</td>";
                echo "</tr>";
            }
            echo "</table>";
        };

        return response()->stream($callback, 200, $headers);
    }

    public function create()
    {
        $user = auth()->user();
        // GT mengisi sendiri apa yang dialami untuk diadukan ke admin
        $gtList = User::where('role','gt')->orderBy('name')->get();
        $namaMadrasah = Permohonan::where('username',$user->username)
            ->where(function($q){ $q->whereNull('extra_answers')->orWhere('extra_answers','not like','%form-ijin-gt%'); })
            ->latest()->value('nama_madrasah') ?? '';
        // Untuk GT, madrasah diambil dari tugasnya
        if ($user->role === 'gt' && empty($namaMadrasah)) {
            $namaMadrasah = Permohonan::where('status','Diterima')->latest()->value('nama_madrasah') ?? '';
        }
        $kategoriList = Pengaduan::KATEGORI;
        return view('pengaduan.create', compact('gtList','namaMadrasah','kategoriList'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        // GT — SIMPLE: cukup judul + apa yang dialami
        if ($user->role === 'gt') {
            $request->validate([
                'nama_pelapor' => 'required|string|max:255',
                'status_pelapor' => 'required|in:Masyarakat,Lembaga,SPGT,Lainnya',
                'kontak_pelapor' => 'required|string|max:100',
                'tempat_tugas' => 'nullable|string|max:255',
                'judul' => 'required|string|max:255',
                'tanggal_kejadian' => 'nullable|date',
                'lokasi' => 'nullable|string|max:255',
                'jenis_pelanggaran' => 'nullable|in:Ringan,Sedang,Berat',
                'kronologi' => 'required|string|max:3000',
                'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'tindak_lanjut' => 'nullable|string|max:2000',
                'tempat_tanggal' => 'nullable|string|max:255',
            ]);
            $buktiPath = $request->hasFile('bukti_foto') ? $request->file('bukti_foto')->store('bukti-pengaduan','public') : null;
            $namaMadrasah = $request->tempat_tugas ?? Permohonan::where('status','Diterima')->latest()->value('nama_madrasah') ?? '';
            Pengaduan::create([
                'pjgt_user_id' => $user->id,
                'gt_user_id' => $user->id,
                'nama_madrasah' => $namaMadrasah,
                'nama_pelapor' => $request->nama_pelapor,
                'status_pelapor' => $request->status_pelapor,
                'kontak_pelapor' => $request->kontak_pelapor,
                'nama_terlapor' => $user->name,
                'tempat_tugas' => $request->tempat_tugas ?? $namaMadrasah,
                'judul' => substr($request->kronologi,0,80),
                'kategori' => $request->jenis_pelanggaran ?? 'Lainnya',
                'deskripsi' => $request->kronologi,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'lokasi' => $request->lokasi,
                'jenis_pelanggaran' => $request->jenis_pelanggaran,
                'kronologi' => $request->kronologi,
                'bukti_pendukung' => $buktiPath,
                'bukti_foto_path' => $buktiPath,
                'tindak_lanjut' => $request->tindak_lanjut,
                'tempat_tanggal' => $request->tempat_tanggal,
                'status' => 'Menunggu',
            ]);
            return redirect()->route('pengaduan.index')->with('success','Pengaduan Anda berhasil dikirim ke Admin.');
        }

        // PJGT/Admin (jika masih dipakai)
        $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'status_pelapor' => 'required|in:Masyarakat,Lembaga,SPGT,Lainnya',
            'kontak_pelapor' => 'required|string|max:100',
            'gt_user_id' => 'required|exists:users,id',
            'tempat_tugas' => 'nullable|string|max:255',
            'tanggal_kejadian' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255',
            'jenis_pelanggaran' => 'nullable|in:Ringan,Sedang,Berat',
            'kronologi' => 'required|string|max:3000',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tindak_lanjut' => 'nullable|string|max:2000',
            'tempat_tanggal' => 'nullable|string|max:255',
        ]);
        $pjgt = $user;
        $gt = User::where('id',$request->gt_user_id)->where('role','gt')->firstOrFail();
        $namaMadrasah = $request->tempat_tugas ?? Permohonan::where('username',$pjgt->username)->latest()->value('nama_madrasah') ?? '';
        $buktiPath = $request->hasFile('bukti_foto') ? $request->file('bukti_foto')->store('bukti-pengaduan','public') : null;
        Pengaduan::create([
            'pjgt_user_id' => $pjgt->id,
            'gt_user_id' => $gt->id,
            'nama_madrasah' => $namaMadrasah,
            'nama_pelapor' => $request->nama_pelapor,
            'status_pelapor' => $request->status_pelapor,
            'kontak_pelapor' => $request->kontak_pelapor,
            'nama_terlapor' => $gt->name,
            'tempat_tugas' => $request->tempat_tugas ?? $namaMadrasah,
            'judul' => substr($request->kronologi,0,80),
            'kategori' => $request->jenis_pelanggaran ?? 'Lainnya',
            'deskripsi' => $request->kronologi,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'lokasi' => $request->lokasi,
            'jenis_pelanggaran' => $request->jenis_pelanggaran,
            'kronologi' => $request->kronologi,
            'bukti_pendukung' => $buktiPath,
            'bukti_foto_path' => $buktiPath,
            'tindak_lanjut' => $request->tindak_lanjut,
            'tempat_tanggal' => $request->tempat_tanggal,
            'status' => 'Menunggu',
        ]);
        return redirect()->route('pengaduan.index')->with('success','Pengaduan GT '.$gt->name.' berhasil dikirim.');
    }

    public function show(Pengaduan $pengaduan)
    {
        $user = auth()->user();
        // PJGT & GT hanya boleh lihat pengaduan buatannya sendiri
        if (in_array($user->role, ['pjgt', 'gt']) && $pengaduan->pjgt_user_id !== $user->id) abort(403);
        $pengaduan->load(['pjgt','gt']);
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        if ((auth()->user()->role ?? '') !== 'admin') abort(403);
        $request->validate([
            'status' => 'required|in:Menunggu,Ditindaklanjuti,Selesai,Ditolak',
            'tanggapan_admin' => 'nullable|string|max:1000',
        ]);
        $pengaduan->update([
            'status' => $request->status,
            'tanggapan_admin' => $request->tanggapan_admin,
        ]);
        return back()->with('success','Status pengaduan diubah ke '.$request->status);
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if (auth()->user()->role !== 'admin' && $pengaduan->pjgt_user_id !== auth()->id()) abort(403);
        $pengaduan->delete();
        return back()->with('success','Pengaduan dihapus');
    }
}
