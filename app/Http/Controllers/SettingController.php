<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(){ $this->middleware('role:admin'); }

    public function index()
    {
        $tahun = Setting::tahunAjaran();
        $mode = Setting::get('tahun_ajaran_mode', 'manual');
        $manual = Setting::get('tahun_ajaran', config('app.tahun_ajaran', '1448/1449'));
        $hijri = Setting::hijriTahunAjaran();
        return view('admin.setting.index', compact('tahun', 'mode', 'manual', 'hijri'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'mode' => 'required|in:manual,auto',
            'tahun_ajaran' => ['required_if:mode,manual', 'nullable', 'string', 'max:20', 'regex:/^\d{4}\/\d{4}$/'],
        ], [
            'tahun_ajaran.regex' => 'Format harus 4 digit / 4 digit, contoh: 1449/1450',
        ]);
        Setting::set('tahun_ajaran_mode', $data['mode']);
        if ($data['mode'] === 'manual' && ! empty($data['tahun_ajaran'])) {
            Setting::set('tahun_ajaran', $data['tahun_ajaran']);
        }
        $aktif = Setting::tahunAjaran();
        return back()->with('success', 'Pengaturan disimpan. Tahun ajaran aktif: ' . $aktif . '.');
    }
}
