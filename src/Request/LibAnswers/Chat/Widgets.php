<?php

declare(strict_types=1);

namespace Lits\Springshare\Request\LibAnswers\Chat;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\MapperBuilder;
use Lits\Springshare\Data\LibAnswers\Chat\Widgets as Data;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

final class Widgets extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly ?int $id = null,
        protected MapperBuilder $mapperBuilder = new MapperBuilder(),
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

    /** @throws MappingError */
    #[\Override]
    public function createDtoFromResponse(Response $response): Data
    {
        return $this->mapperBuilder
            ->allowSuperfluousKeys()
            ->allowUndefinedValues()
            ->mapper()
            ->map(Data::class, $response->json());
    }
}
