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
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'image_url' => $this->image ? env('APP_URL').'/storage/'.$this->image : env('APP_URL').'/storage/'.env('DEFAULT_IMAGE'),
            'content' => $this->content,
            // 'user_id' => $this->user->name
            // 'category_id' => $this->category_id,
            // 'tags' => $this->tags,
            // 'is_visible' => $this->is_visible,
            // 'post_views' => $this->post_views,
            // 'start_date' => $this->start_date,
            // 'end_date' => $this->end_date,
            // 'created_at' => $this->created_at->toDateTimeString(),
            // 'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
