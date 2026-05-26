<?php

declare(strict_types=1);

namespace Lits\Springshare\Data\LibAnswers;

use Lits\Springshare\Data\LibAnswers\FormFields\FormField;

/** @implements \IteratorAggregate<int, FormField> */
final readonly class FormFields implements \IteratorAggregate
{
    /** @param list<FormField> $formFields */
    public function __construct(
        public array $formFields,
    ) {}

    /** @return \Traversable<int, FormField> */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->formFields);
    }
}
