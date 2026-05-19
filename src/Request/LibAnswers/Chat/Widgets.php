<?php

declare(strict_types=1);

namespace Lits\Springshare\Request\LibAnswers\Chat;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class Widgets extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly ?int $id = null,
    ) {}

    #[\Override]
    public function resolveEndpoint(): string
    {
        return '/chat/widgets';
    }

    /** @return array<string, mixed> */
    #[\Override]
    protected function defaultQuery(): array
    {
        return ['widget_id' => $this->id];
    }
}
