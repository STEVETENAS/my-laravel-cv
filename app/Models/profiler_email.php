<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class profiler_email extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'profiler_email',
        'email_description',
        'profiler_infos_id',
    ];


    protected $casts = [
        'created_at' => 'datetime:U',
        'updated_at' => 'datetime:U',
        'deleted_at' => 'datetime:U',
    ];

    public function profiler_emails(): BelongsTo
    {
        return $this->belongsTo(profiler_info::class, 'profiler_infos_id');
    }
}
