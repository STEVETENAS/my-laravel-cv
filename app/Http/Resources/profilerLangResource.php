<?php

namespace App\Http\Resources;

use App\Models\profilerInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class profilerLangResource extends JsonResource
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
            'language' => $this->language,
            'language_level' => $this->language_level,
            'profiler_info' => profilerInfo::query()->where('id', '=', $this->profiler_infos_id)->get(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
