<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gt()
    {
        return $this->belongsTo(User::class, 'gt_user_id');
    }

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class);
    }

    // Scope: penempatan ke lembaga milik PJGT tertentu
    public static function untukPjgt($user)
    {
        return static::whereHas('permohonan', function ($q) use ($user) {
            $q->where('username', $user->username);
        });
    }

    // Jumlah belum dibaca (badge merah): penempatan yg berubah setelah terakhir dibuka
    public static function unreadUntukPjgt($user)
    {
        if (! \Schema::hasTable('penempatan_reads')) {
            return static::untukPjgt($user)->count();
        }
        $readAt = \DB::table('penempatan_reads')->where('user_id', $user->id)->value('read_at');
        $query = static::untukPjgt($user);
        if ($readAt) {
            $query->where('updated_at', '>', $readAt);
        }
        return $query->count();
    }

    // Tandai sudah dibaca (dipanggil saat halaman dibuka)
    public static function tandaiDibaca($user)
    {
        if (! \Schema::hasTable('penempatan_reads')) {
            return;
        }
        \DB::table('penempatan_reads')->updateOrInsert(
            ['user_id' => $user->id],
            ['read_at' => now(), 'updated_at' => now(), 'created_at' => \DB::raw('COALESCE(created_at, NOW())')]
        );
    }
}
