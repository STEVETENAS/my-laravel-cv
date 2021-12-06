<?php

namespace App\Http\Resources;

use App\Models\profilerInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class profilerProjectResource extends JsonResource
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
            'project_name' => $this->project_name,
            'project_description' => $this->project_description,
            'profiler_info' => profilerInfo::query()->where('id', '=', $this->profiler_infos_id)->get(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
