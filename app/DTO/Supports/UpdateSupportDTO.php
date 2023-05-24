<?php

namespace App\DTO\Supports;

use App\Enums\SupportStatus;
use App\Http\Requests\SupportRequest;

class UpdateSupportDTO
{
    public function __construct(
        public string $id,
        public string $subject,
        public SupportStatus $status,
        public string $content
    ) {
    }

    public static function makeFromRequest(SupportRequest $request, string $id = null): self
    {
        return new self(
            $id ?? $request->id,
            $request->subject,
            SupportStatus::A,
            $request->content
        );
    }
}
