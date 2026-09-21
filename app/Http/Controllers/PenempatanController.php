<?php

namespace App\Http\Controllers;

use App\Models\Penempatan;
use App\Models\Permohonan;
use App\Models\User;
use Illuminate\Http\Request;

class PenempatanController extends Controller
{
    public function __construct(){ $this->middleware('role:admin'); }

    // Daftar semua GT + lembaga penempatannya
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = User::with(['penempatan.permohonan'])->where('role', 'gt')->orderBy('name');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('username', 'like', "%{$search}%");
            });
        }
        $gts = $query->paginate(15)->withQueryString();
        $sudah = Penempatan::count();
        return view('admin.penempatan.index', compact('gts', 'search', 'sudah'));
    }

    // Form tempatkan / pindahkan 1 GT
    public function create(Request $request)
    {
        $gt = User::where('role', 'gt')->findOrFail($request->query('gt', 0) ?: 0);
        $gt->load('penempatan');
        $lembagas = Permohonan::where('status', 'Diterima')
            ->orderBy('nama_madrasah')
            ->get(['id', 'pjgt_id', 'nama_madrasah', 'desa', 'kecamatan', 'kabupaten', 'wil', 'butuh_gt']);
        return view('admin.penempatan.form', compact('gt', 'lembagas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'gt_user_id' => 'required|exists:users,id',
            'permohonan_id' => 'required|exists:permohonans,id',
            'catatan' => 'nullable|string|max:500',
        ]);
        $gt = User::where('id', $data['gt_user_id'])->where('role', 'gt')->firstOrFail();
        $lembaga = Permohonan::where('id', $data['permohonan_id'])->where('status', 'Diterima')->firstOrFail();
        Penempatan::updateOrCreate(
            ['gt_user_id' => $gt->id],
            ['permohonan_id' => $lembaga->id, 'catatan' => $data['catatan'] ?? null]
        );
        return redirect()->route('penempatan.index')->with('success', $gt->name . ' ditempatkan di ' . $lembaga->nama_madrasah);
    }

    // Export Penempatan GT — Excel (.xls), khusus admin, siap cetak
    public function export(Request $request)
    {
        $search = $request->query('search');
        $query = User::with(['penempatan.permohonan'])->where('role', 'gt')->orderBy('name');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('username', 'like', "%{$search}%");
            });
        }
        $data = $query->get();

        $filename = 'Penempatan-GT_'.date('Y-m-d_His').'.xls';
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        $callback = function() use ($data) {
            echo "\xEF\xBB\xBF";
            echo "<table border='1'>";
            echo "<tr><th colspan='7' style='background:#0a3d1f;color:#d4af37;text-align:center;font-size:14px'>TMTB & DAI KIK — PP KUNUUZUL IMAM KAUMAN • Penempatan GT • Total: ".$data->count()."</th></tr>";
            echo "<tr style='background:#d4af37;color:#0a3d1f;font-weight:bold'><th>No</th><th>GT</th><th>Username</th><th>Email</th><th>Lembaga Penempatan</th><th>Wilayah</th><th>Catatan</th></tr>";
            foreach ($data as $i => $g) {
                $p = $g->penempatan && $g->penempatan->permohonan ? $g->penempatan->permohonan : null;
                $lokasi = $p ? trim(($p->desa ?? '').' • '.($p->kecamatan ?? '').' • '.($p->kabupaten ?? ''), ' •') : '-';
                echo "<tr>";
                echo "<td>".($i + 1)."</td>";
                echo "<td>".htmlspecialchars($g->name ?? '-')."</td>";
                echo "<td>".htmlspecialchars($g->username ?? '-')."</td>";
                echo "<td>".htmlspecialchars($g->email ?? '-')."</td>";
                echo "<td>".htmlspecialchars($p->nama_madrasah ?? 'Belum ditempatkan')."</td>";
                echo "<td>".htmlspecialchars($p ? ($lokasi.' ('.($p->wil ?? '-').')') : '-')."</td>";
                echo "<td>".htmlspecialchars($g->penempatan->catatan ?? '-')."</td>";
                echo "</tr>";
            }
            echo "</table>";
        };

        return response()->stream($callback, 200, $headers);
    }

    // Lepas penempatan (GT kembali lihat semua)
    public function destroy(Penempatan $penempatan)
    {
        $nama = $penempatan->gt->name ?? 'GT';
        $penempatan->delete();
        return back()->with('success', 'Penempatan ' . $nama . ' dilepas.');
    }
}
