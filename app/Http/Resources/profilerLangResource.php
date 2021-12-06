<?php

namespace App\Http\Resources;

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
            'profiler_info' => profilerInfoResource::make($this->profilerInfos),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
