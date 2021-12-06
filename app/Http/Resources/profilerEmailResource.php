<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class profilerEmailResource extends JsonResource
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
            'profiler_email' => $this->profiler_email,
            'email_description' => $this->email_description,
            'profiler_info' => profilerInfoResource::make($this->profilerInfos),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
