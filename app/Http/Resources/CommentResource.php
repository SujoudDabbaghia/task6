<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'titel'=>$this->titel,
            'description'=>$this->description,
            'user_id'=>new UserResource($this->user),
            'post_id'=>new PostResource($this->post),
            'opinion'=>$this->opinion,    
        ];
    }
}
