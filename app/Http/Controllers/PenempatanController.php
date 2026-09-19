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

    // Lepas penempatan (GT kembali lihat semua)
    public function destroy(Penempatan $penempatan)
    {
        $nama = $penempatan->gt->name ?? 'GT';
        $penempatan->delete();
        return back()->with('success', 'Penempatan ' . $nama . ' dilepas.');
    }
}
