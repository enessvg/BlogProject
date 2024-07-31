<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Post;

class SinglePostResource extends JsonResource
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
            'user_id' => $this->user->name,
            'category_id' => $this->category->name,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'image_url' => env('APP_URL').'/storage/'.$this->image,
            'content' => $this->content,
            'tags' => $this->tags,
            'post_views' => $this->post_views,
            'created_at' => $this->created_at,
        ];
    }
}
