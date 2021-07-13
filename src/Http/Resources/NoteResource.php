<?php

namespace PDMFC\NovaNotesField\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'notable_type' => $this->notable_type,
            'notable_id' => $this->notable_id,
            'note' => $this->note,
            'author' => $this->author,
            'notes' => NoteResource::collection($this->whenLoaded('notes')),
            'authorizedToDelete' => $this->created_by === auth()->id(),
            'created_at' => $this->created_at,
            'personal' => $this->personal,
            'as_html' => $this->as_html
        ];
    }
}
