<?php

namespace App\Http\Controllers;

use App\Models\LayananSaran;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $sarans = LayananSaran::with('user')->latest()->paginate(10);
        // Kontak tetap PP KUNUUZUL IMAM KAUMAN
        $kontak = [
            'alamat' => 'Jln KH Zainul Arifin No.165 Kauman, Bondowoso 68213',
            'telepon' => '081249811242',
            'email' => 'kunuzulimam@gmail.com',
            'wa' => 'https://wa.me/628124981242',
        ];
        return view('layanan.index', compact('sarans','kontak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'saran' => 'required|string|max:2000',
            'kontak' => 'nullable|string|max:100',
        ]);
        LayananSaran::create([
            'user_id' => auth()->id(),
            'nama' => auth()->user()->name,
            'kontak' => $request->kontak ?? auth()->user()->email,
            'saran' => $request->saran,
            'status' => 'Baru',
        ]);
        return back()->with('success','Terima kasih — saran/masukan Anda berhasil dikirim.');
    }

    public function destroy(LayananSaran $saran)
    {
        if (auth()->user()->role !== 'admin' && $saran->user_id !== auth()->id()) abort(403);
        $saran->delete();
        return back()->with('success','Saran dihapus');
    }

    // Export Layanan/Saran — Excel (.xls), khusus admin, siap cetak
    public function export(Request $request)
    {
        if ((auth()->user()->role ?? '') !== 'admin') abort(403);
        $data = LayananSaran::with('user')->latest()->get();

        $filename = 'Layanan-Saran_'.date('Y-m-d_His').'.xls';
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        $callback = function() use ($data) {
            echo "\xEF\xBB\xBF";
            echo "<table border='1'>";
            echo "<tr><th colspan='6' style='background:#0a3d1f;color:#d4af37;text-align:center;font-size:14px'>TMTB & DAI KIK — PP KUNUUZUL IMAM KAUMAN • Layanan Saran/Masukan • Total: ".$data->count()."</th></tr>";
            echo "<tr style='background:#d4af37;color:#0a3d1f;font-weight:bold'><th>No</th><th>Nama</th><th>Kontak</th><th>Saran/Masukan</th><th>Status</th><th>Tanggal</th></tr>";
            foreach ($data as $i => $s) {
                echo "<tr>";
                echo "<td>".($i + 1)."</td>";
                echo "<td>".htmlspecialchars($s->nama ?? $s->user->name ?? '-')."</td>";
                echo "<td>".htmlspecialchars($s->kontak ?? '-')."</td>";
                echo "<td>".htmlspecialchars($s->saran ?? '-')."</td>";
                echo "<td>".htmlspecialchars($s->status ?? '-')."</td>";
                echo "<td>".htmlspecialchars($s->created_at ? $s->created_at->format('d-m-Y H:i') : '-')."</td>";
                echo "</tr>";
            }
            echo "</table>";
        };

        return response()->stream($callback, 200, $headers);
    }
}
