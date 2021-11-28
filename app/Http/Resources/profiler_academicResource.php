<?php

namespace App\Http\Resources;

use App\Models\profiler_info;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class profiler_academicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'diploma_title' => $this->diploma_title,
            'diploma_description' => $this->diploma_description,
            'institution_attended' => $this->institution_attended,
            'profiler_info' => profiler_info::collection($this->profiler_info_id),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
