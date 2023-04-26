<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FireAndIceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "dvok" => "Sfgbmk",
            // "name" => $this->name,
            // "isbn" => $this->isbn,
            // "authors" => $this->authors,
            // "number_of_pages" => $this->numberOfPages,
            // "publisher" => $this->publisher,
            // "country" => $this->country,
            // "release_date" => $this->released,
        ];
    }
}
