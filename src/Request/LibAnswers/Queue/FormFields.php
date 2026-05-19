<?php

declare(strict_types=1);

namespace Lits\Springshare\Request\LibAnswers\Queue;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class FormFields extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly int $queue_id,
    ) {}

    #[\Override]
    public function resolveEndpoint(): string
    {
        return '/queue/' . $this->queue_id . '/formfields';
    }
}
