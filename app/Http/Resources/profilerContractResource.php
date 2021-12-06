<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class profilerContractResource extends JsonResource
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
            'contract_type' => $this->contract_type,
            'contract_description' => $this->contract_description,
            'profiler_info' => profilerInfoResource::make($this->profilerInfos),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
