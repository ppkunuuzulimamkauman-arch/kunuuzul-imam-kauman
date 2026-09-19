<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function get(string $key, $default = null)
    {
        try {
            $row = static::where('key', $key)->first();
            return $row ? $row->value : $default;
        } catch (\Throwable $e) {
            // tabel belum migrate (fresh install) — pakai default
            return $default;
        }
    }

    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function tahunAjaran(): string
    {
        if (static::get('tahun_ajaran_mode', 'manual') === 'auto') {
            return static::hijriTahunAjaran();
        }
        return (string) static::get('tahun_ajaran', config('app.tahun_ajaran', '1448/1449'));
    }

    // Otomatis: H/H+1 dari tahun Hijriah berjalan (ganti sendiri tiap 1 Muharram)
    public static function hijriTahunAjaran(): string
    {
        try {
            $fmt = new \IntlDateFormatter('id@calendar=islamic', \IntlDateFormatter::FULL, \IntlDateFormatter::FULL, 'Asia/Jakarta', \IntlDateFormatter::TRADITIONAL, 'yyyy');
            $h = (int) $fmt->format(time());
            if ($h < 1400 || $h > 1600) {
                throw new \Exception('hijri out of range');
            }
            return $h . '/' . ($h + 1);
        } catch (\Throwable $e) {
            return (string) static::get('tahun_ajaran', config('app.tahun_ajaran', '1448/1449'));
        }
    }
}
