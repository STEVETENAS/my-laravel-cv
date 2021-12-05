<?php

namespace App\Http\Resources;

use App\Models\profiler_info;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class profiler_academicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'diploma_title' => "mixed", 'diploma_description' => "mixed", 'institution_attended' => "mixed", 'profiler_info' => "mixed", 'created_at' => "mixed", 'updated_at' => "mixed"])] public function toArray($request): array
    {
        $profiler = profiler_info::query()->where('id', '=', $this->profiler_infos_id)->get();

        return [
            'id' => $this->id,
            'diploma_title' => $this->diploma_title,
            'diploma_description' => $this->diploma_description,
            'institution_attended' => $this->institution_attended,
            'profiler_info' => profiler_info::query()->where('id', '=', $this->profiler_infos_id)->get(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
