<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class profiler_info extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'profession',
        'place_of_origin',
        'number_of_children',
        'married',
        'profiler_image',
        'background_image',
    ];

//    protected $dateFormat = 'U';

    protected $casts = [
        'created_at' => 'datetime:U',
        'updated_at' => 'datetime:U',
        'deleted_at' => 'datetime:U',
    ];

    public function profiler_academic(): HasMany
    {
        return $this->hasMany(profiler_academic::class);
    }

    public function profiler_contract(): HasMany
    {
        return $this->hasMany(profiler_contract::class);
    }

    public function profiler_email(): HasMany
    {
        return $this->hasMany(profiler_email::class);
    }

    public function profiler_exp(): HasMany
    {
        return $this->hasMany(profiler_exp::class);
    }

    public function profiler_ip(): HasMany
    {
        return $this->hasMany(profiler_ip::class);
    }

    public function profiler_lang(): HasMany
    {
        return $this->hasMany(profiler_lang::class);
    }

    public function profiler_medical(): HasMany
    {
        return $this->hasMany(profiler_medical::class);
    }

    public function profiler_project(): HasMany
    {
        return $this->hasMany(profiler_project::class);
    }

    public function profiler_resident(): HasMany
    {
        return $this->hasMany(profiler_resident::class);
    }

    public function profiler_skill(): HasMany
    {
        return $this->hasMany(profiler_skill::class);
    }

    public function profiler_telephone(): HasMany
    {
        return $this->hasMany(profiler_telephone::class);
    }
}
