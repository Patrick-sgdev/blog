<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'user' => $this->author->name,
            'slug' => $this->slug,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'banner' => asset_path($this->banner),
            'status' => $this->status,
            'content' => $this->content,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
            'categories' => $this->categories->pluck('name')->toArray(),
            'tags' => $this->tags->pluck('name')->toArray(),
        ];
    }
}
