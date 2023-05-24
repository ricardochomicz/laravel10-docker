<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
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
            'subject' => $this->subject,
            'status' => getStatusSupport($this->status),
            'content' => $this->content,
            'created_at' => \Carbon\Carbon::parse($this->created_at)->format('d/m/Y'),
            'updated_at' => \Carbon\Carbon::parse($this->updated_at)->format('d/m/Y'),
        ];
    }
}
