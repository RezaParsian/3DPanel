<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'project_id' => $this->project_id,
            'project' => ProjectResource::make($this->whenLoaded('project')),
            'path' => asset($this->path),
            'data' => $this->data,
            'code' => $this->code,
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}
