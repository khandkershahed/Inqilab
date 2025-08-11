<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RelatedNewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                     => $this->id,
            'title'                  => $this->title,
            'bangla_title'           => $this->bangla_title,
            'slug'                   => $this->slug,
            'thumbnail'              => $this->thumbnail ?? null,
            'status'                 => $this->status,
            'published_at'           => $this->published_at,
            'category_name'          => optional($this->category)->name,
            'category_bangla_name'   => optional($this->category)->bangla_name,
            'subCategory_name'       => optional($this->subCategory)->name,
            'subCategory_bangla_name' => optional($this->subCategory)->bangla_name,
        ];
    }
}
