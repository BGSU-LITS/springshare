<?php

declare(strict_types=1);

namespace Lits\Springshare\Request\LibAnswers\Queue;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\MapperBuilder;
use Lits\Springshare\Data\LibAnswers\FormFields as Data;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

final class FormFields extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly int $queue_id,
        protected MapperBuilder $mapperBuilder = new MapperBuilder(),
    ) {}

    #[\Override]
    public function resolveEndpoint(): string
    {
        return '/queue/' . $this->queue_id . '/formfields';
    }

    /** @throws MappingError */
    #[\Override]
    public function createDtoFromResponse(Response $response): Data
    {
        return $this->mapperBuilder
            ->allowSuperfluousKeys()
            ->allowUndefinedValues()
            ->mapper()
            ->map(Data::class, ['formFields' => $response->json()]);
    }
}
