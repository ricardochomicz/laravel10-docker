<?php

declare(strict_types=1);

namespace App\DTO\Supports;

use App\Enums\SupportStatus;
use App\Http\Requests\SupportRequest;

class CreateSupportDTO
{
    public function __construct(
        public string $subject,
        public SupportStatus $status,
        public string $content
    ) {
    }

    public static function makeFromRequest(SupportRequest $request): self
    {
        return new self(
            $request->subject,
            SupportStatus::A,
            $request->content
        );
    }
}
