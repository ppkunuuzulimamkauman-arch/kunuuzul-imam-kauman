<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LayananSaran extends Model
{
    protected $fillable = ['user_id','nama','kontak','saran','status'];
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
}
