<?php

declare(strict_types=1);

namespace Lits\Springshare\Data\LibAnswers\FormFields;

final readonly class FormField
{
    /**
     * @param list<Option>|null $options
     */
    public function __construct(
        public ?int $id,
        public ?string $name,
        public string $label,
        public string $html_type,
        public string $data_type,
        public ?bool $required,
        public ?array $options,
    ) {}
}
