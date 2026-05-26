<?php

declare(strict_types=1);

namespace Lits\Springshare\Data\LibAnswers\Chat\Widgets;

final readonly class User
{
    public function __construct(
        public string $name,
        public int $account_id,
    ) {}
}
