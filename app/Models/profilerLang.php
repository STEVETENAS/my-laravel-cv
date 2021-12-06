<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class profilerLang extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'language',
        'language_level',
        'profiler_infos_id',
    ];


    protected $casts = [
        'created_at' => 'datetime:U',
        'updated_at' => 'datetime:U',
        'deleted_at' => 'datetime:U',
    ];

    public function profiler_infos(): BelongsTo
    {
        return $this->belongsTo(profilerInfo::class, 'profiler_infos_id');
    }
}
