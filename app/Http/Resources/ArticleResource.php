<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'subject' => $this->subject,
            'body' => substr($this->body, 0, 100). '...' ,
            'image' => $this->image,
            'likes' => $this->likes,
            'views' => $this->views,
            'tags' => TagResource::collection($this->tags),
            'comments' => CommentResource::collection($this->comments)
        ];
    }
}
