<?php

declare(strict_types=1);

namespace Lits\Springshare\Data\LibAnswers\Chat\Widgets;

final readonly class Code
{
    public function __construct(
        public string $html,
        public string $script,
    ) {}
}
