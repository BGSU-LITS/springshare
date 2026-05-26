<?php

declare(strict_types=1);

namespace Lits\Springshare\Data\LibAnswers\FormFields;

final readonly class Option
{
    public function __construct(
        public int $value,
        public string $label,
        public ?int $queue_id,
        public ?string $queue_name,
        public ?int $user_id,
        public ?string $user_name,
    ) {}
}
