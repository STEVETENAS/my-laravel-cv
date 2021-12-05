<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class profiler_exp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'job_title',
        'job_description',
        'company_name',
        'company_website',
        'job_start_date',
        'job_end_date',
        'profiler_infos_id',
    ];


    protected $casts = [
        'created_at' => 'datetime:U',
        'updated_at' => 'datetime:U',
        'deleted_at' => 'datetime:U',
    ];

    public function profiler_exps(): BelongsTo
    {
        return $this->belongsTo(profiler_info::class, 'profiler_infos_id');
    }
}
