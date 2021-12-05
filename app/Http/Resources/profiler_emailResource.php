<?php

namespace App\Http\Resources;

use App\Models\profiler_info;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class profiler_emailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $profiler = profiler_info::query()->where('id', '=', $this->profiler_infos_id)->get();

        return [
            'id' => $this->id,
            'profiler_email' => $this->profiler_email,
            'email_description' => $this->email_description,
            'profiler_info' => $profiler,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
