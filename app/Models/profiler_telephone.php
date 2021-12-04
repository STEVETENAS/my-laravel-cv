<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class profiler_telephone extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'profiler_phone_number',
        'phone_number_description',
        'profiler_info_id',
    ];


    protected $casts = [
        'created_at' => 'datetime:U',
        'updated_at' => 'datetime:U',
        'deleted_at' => 'datetime:U',
    ];

    public function profiler_telephones(): BelongsTo
    {
        return $this->belongsTo(profiler_info::class, 'profiler_info_id');
    }
}
