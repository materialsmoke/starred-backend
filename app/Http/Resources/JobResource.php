<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            "id" => $this->id,
            "title" => $this->title,
            "short_description" => $this->short_description,
            "long_description" => $this->long_description,
            "recruiter" => $this->recruiter,
            "category" => $this->category,
            "company" => $this->company,
            "job_type" => $this->jobType,
            "location" => $this->location,
            "created_at" => $this->created_at->format('M d Y H:i'),
            "updated_at" => $this->updated_at,
            "is_favorite" => (count($this->favorites) > 0 ?? false),
        ];
    }
}
