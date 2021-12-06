<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class profilerInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profiler_infos';

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

    protected $casts = [
        'created_at' => 'datetime:U',
        'updated_at' => 'datetime:U',
        'deleted_at' => 'datetime:U',
    ];

    public function ProfilerAcademic(): HasMany
    {
        return $this->hasMany(profilerAcademic::class);
    }

    public function profilerContracts(): HasMany
    {
        return $this->hasMany(profilerContract::class);
    }

    public function profiler_emails(): HasMany
    {
        return $this->hasMany(profilerEmail::class);
    }

    public function profiler_exps(): HasMany
    {
        return $this->hasMany(profilerExp::class);
    }

    public function profiler_ips(): HasMany
    {
        return $this->hasMany(profilerIp::class);
    }

    public function profiler_langs(): HasMany
    {
        return $this->hasMany(profilerLang::class);
    }

    public function profiler_medicals(): HasMany
    {
        return $this->hasMany(profilerMedical::class);
    }

    public function profiler_projects(): HasMany
    {
        return $this->hasMany(profilerProject::class);
    }

    public function profiler_residents(): HasMany
    {
        return $this->hasMany(profilerResident::class);
    }

    public function profiler_skills(): HasMany
    {
        return $this->hasMany(profilerSkill::class);
    }

    public function profiler_telephones(): HasMany
    {
        return $this->hasMany(profilerTelephone::class);
    }
}
