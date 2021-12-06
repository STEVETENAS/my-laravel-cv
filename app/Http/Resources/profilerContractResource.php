<?php

namespace App\Http\Resources;

use App\Models\profilerInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class profilerContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'contract_type' => "mixed", 'contract_description' => "mixed", 'profiler_info' => "\Illuminate\Http\Resources\Json\AnonymousResourceCollection", 'created_at' => "mixed", 'updated_at' => "mixed"])]
    public function toArray($request): array
    {
        $profiler = profilerInfo::query()->where('id', '=', $this->profiler_infos_id)->get();
        return [
            'id' => $this->id,
            'contract_type' => $this->contract_type,
            'contract_description' => $this->contract_description,
            'profiler_info' => $profiler,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
