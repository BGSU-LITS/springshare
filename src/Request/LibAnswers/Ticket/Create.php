<?php

declare(strict_types=1);

namespace Lits\Springshare\Request\LibAnswers\Ticket;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasFormBody;

final class Create extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /** @param array<mixed> $fields */
    public function __construct(
        protected int $quid,
        protected string $pquestion,
        protected bool $confirm_email = false,
        protected array $fields = [],
    ) {}

    #[\Override]
    public function resolveEndpoint(): string
    {
        return '/ticket/create';
    }

    /** @return array<mixed> */
    protected function defaultBody(): array
    {
        $standard = [
            'quid' => $this->quid,
            'pquestion' => $this->pquestion,
            'confirm_email' => (int) $this->confirm_email,
        ];

        return $standard + $this->fields;
    }
}
