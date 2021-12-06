<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class profilerExpResource extends JsonResource
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
            'job_title' => $this->job_title,
            'job_description' => $this->job_description,
            'company_name' => $this->company_name,
            'company_website' => $this->company_website,
            'job_start_date' => $this->job_start_date,
            'job_end_date' => $this->job_end_date,
            'profiler_info' => profilerInfoResource::make($this->profilerInfos),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
