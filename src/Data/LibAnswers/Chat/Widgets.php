<?php

declare(strict_types=1);

namespace Lits\Springshare\Data\LibAnswers\Chat;

use Lits\Springshare\Data\LibAnswers\Chat\Widgets\Widget;

/** @implements \IteratorAggregate<int, Widget> */
final readonly class Widgets implements \IteratorAggregate
{
    /**
     * @param list<Widget> $widgets
     */
    public function __construct(
        public array $widgets,
    ) {}

    /** @return \Traversable<int, Widget> */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->widgets);
    }
}
