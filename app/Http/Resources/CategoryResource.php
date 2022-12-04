<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "hot" => $this->hot,
            "children" => $this->when(!is_null($this->categoryChildren), CategoryResource::collection($this->categoryChildren)),
            "parent_id" => $this->parent_id

        ];
    }
}
