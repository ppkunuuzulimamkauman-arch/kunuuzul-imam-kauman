<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Permohonan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $isAdmin = $user->role === 'admin';
        $isPjgt = $user->role === 'pjgt';
        $isGt = $user->role === 'gt';

        // Base query filtered by role
        // GT yang sudah ditempatkan admin hanya lihat lembaganya (via penempatans)
        $base = Permohonan::query();
        if ($isPjgt) $base->where('username', $user->username);
        elseif ($isGt) {
            $placedId = \App\Models\Penempatan::where('gt_user_id', $user->id)->value('permohonan_id');
            if ($placedId) $base->whereKey($placedId);
            else $base->where('status', 'Diterima');
        }

        $total = (clone $base)->count();
        $proses = (clone $base)->where('status','Proses')->count();
        $diterima = (clone $base)->where('status','Diterima')->count();
        $ditolak = (clone $base)->where('status','Ditolak')->count();
        $butuhGt = (clone $base)->sum('butuh_gt');
        $madrasahDistinct = (clone $base)->distinct()->count('nama_madrasah');
        $pjgtDistinct = Permohonan::distinct()->count('username');
        // Global for admin header
        $allTotal = Permohonan::count();
        $allProses = Permohonan::where('status','Proses')->count();

        $byStatus = (clone $base)->selectRaw('status, count(*) as c')->groupBy('status')->pluck('c','status');
        $byRapot = (clone $base)->selectRaw('rapot, count(*) as c')->groupBy('rapot')->pluck('c','rapot');
        $byWil = (clone $base)->selectRaw('wil, count(*) as c')->groupBy('wil')->pluck('c','wil');
        $byProv = (clone $base)->selectRaw('provinsi, count(*) as c')->groupBy('provinsi')->orderByDesc('c')->limit(5)->pluck('c','provinsi');

        $recent = (clone $base)->latest()->take(5)->get();
        // Tugas utama GT/PJGT = penempatan Diterima terbaru (untuk biodata + pembimbing) — PJGT disamakan dengan GT
        $tugasUtama = ($isGt || $isPjgt) ? (clone $base)->latest()->first() : null;
        // Antrian approve - only for admin
        $pending = $isAdmin ? Permohonan::where('status','Proses')->latest()->take(5)->get() : collect();
        // Top PJGT
        $topPjgt = Permohonan::selectRaw('pjgt_nama, username, count(*) as c')->groupBy('pjgt_nama','username')->orderByDesc('c')->limit(5)->get();
        // GT users
        $gtCount = \App\Models\User::where('role','gt')->count();
        $pjgtUserCount = \App\Models\User::where('role','pjgt')->count();
        // Admin — rangkuman semua yang diperbarui (aduan, layanan, laporan GT)
        $pengaduanTotal = \App\Models\Pengaduan::count();
        $pengaduanMenunggu = \App\Models\Pengaduan::where('status','Menunggu')->count();
        $layananTotal = \App\Models\LayananSaran::count();
        $laporanGtTotal = \App\Models\PjgtLaporanGt::count();
        // Informasi dinamis dari Kelola Landing (admin) untuk tab GT/PJGT
        $infoUmum = \App\Models\LandingContent::where('section','info_umum')->where('is_active',true)->orderBy('sort_order')->orderBy('id')->get();
        $infoPjgt = \App\Models\LandingContent::where('section','info_pjgt')->where('is_active',true)->orderBy('sort_order')->orderBy('id')->get();
        $infoGt = \App\Models\LandingContent::where('section','info_gt')->where('is_active',true)->orderBy('sort_order')->orderBy('id')->get();
        // Pengaduan — dipisah: GT punya aduan sendiri ke Admin, PJGT punya laporan GT melanggar
        $pengaduanGt = collect();
        $pengaduanGtCount = 0;
        $pengaduanPjgt = collect();
        $pengaduanPjgtCount = 0;
        if ($isGt) {
            $pengaduanGt = Pengaduan::with(['pjgt'])->where('pjgt_user_id',$user->id)->latest()->take(3)->get();
            $pengaduanGtCount = Pengaduan::where('pjgt_user_id',$user->id)->count();
        }
        if ($isPjgt) {
            // PJGT hanya lihat pengaduan buatannya sendiri (bukan dari GT)
            $pengaduanPjgt = Pengaduan::with(['gt'])->where('pjgt_user_id',$user->id)->latest()->take(3)->get();
            $pengaduanPjgtCount = Pengaduan::where('pjgt_user_id',$user->id)->count();
        }
        // GT yang ditempatkan admin ke lembaga milik PJGT (pemberitahuan)
        $gtDiLembaga = collect();
        $gtDiLembagaCount = 0;
        if ($isPjgt) {
            $gtQ = \App\Models\Penempatan::with(['gt','permohonan'])
                ->whereHas('permohonan', function ($qq) use ($user) { $qq->where('username', $user->username); });
            $gtDiLembagaCount = \App\Models\Penempatan::unreadUntukPjgt($user);
            $gtDiLembaga = $gtQ->latest()->take(5)->get();
        }

        return view('dashboard.index', compact(
            'total','proses','diterima','ditolak','butuhGt','madrasahDistinct','pjgtDistinct',
            'allTotal','allProses','byStatus','byRapot','byWil','byProv','recent','pending','topPjgt','gtCount','pjgtUserCount','isAdmin','isPjgt','isGt','tugasUtama',
            'pengaduanGt','pengaduanGtCount','pengaduanPjgt','pengaduanPjgtCount',
            'pengaduanTotal','pengaduanMenunggu','layananTotal','laporanGtTotal',
            'infoUmum','infoPjgt','infoGt','gtDiLembaga','gtDiLembagaCount'
        ));
    }
}
