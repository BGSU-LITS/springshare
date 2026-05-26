<?php

declare(strict_types=1);

namespace Lits\Springshare\Data\LibAnswers\Chat\Widgets;

final readonly class Widget
{
    public function __construct(
        public int $widget_id,
        public string $name,
        public string $type,
        public Code $code,
        public User $user,
    ) {}
}
