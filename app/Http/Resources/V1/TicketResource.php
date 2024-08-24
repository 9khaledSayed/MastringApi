<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'ticket',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'description' => $this->when(!$request->routeIs('tickets.index'), $this->description),
                'status' => $this->status,
                'createdAt' => $this->created_at,
            ],
            "links" => [
                'self' => route('tickets.show', $this->id),
            ],
            'includes' => [UserResource::make($this->whenLoaded('author'))],
            "relationships" => [
                'author' => new UserResource($this->whenLoaded('author')),
            ]
        ];
    }
}
