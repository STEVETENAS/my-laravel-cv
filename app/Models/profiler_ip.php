<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class profiler_ip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ip_name',
        'ip_description',
        'ip_img',
        'profiler_info_id',
    ];

    protected $dateFormat = 'U';

    protected $casts = [
        'created_at' => 'datetime:U',
        'updated_at' => 'datetime:U',
        'deleted_at' => 'datetime:U',
    ];

    public function profiler_ips(): BelongsTo
    {
        return $this->belongsTo(profiler_info::class, 'profiler_info_id');
    }
}
