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
}
