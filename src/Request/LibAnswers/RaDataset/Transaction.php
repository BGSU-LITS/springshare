<?php

declare(strict_types=1);

namespace Lits\Springshare\Request\LibAnswers\RaDataset;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasFormBody;

final class Transaction extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /** @param array<int, int> $field */
    public function __construct(
        protected int $dataset_id,
        protected string $owner_email,
        protected ?string $internal_note = null,
        protected ?\DateTimeImmutable $date_time = null,
        protected ?string $question = null,
        protected ?string $q_details = null,
        protected ?string $answer = null,
        protected ?array $field = null,
    ) {}

    #[\Override]
    public function resolveEndpoint(): string
    {
        return '/ra/dataset/' . $this->dataset_id . '/transaction';
    }

    /**
     * @return array<mixed>
     * @throws \DateInvalidTimeZoneException
     */
    protected function defaultBody(): array
    {
        $date_time = null;

        if ($this->date_time !== null) {
            $date_time = $this->date_time
                ->setTimezone(new \DateTimeZone('UTC'))
                ->format('Y-m-d H:i:s');
        }

        return [
            'owner_email' => $this->owner_email,
            'internal_note' => $this->internal_note,
            'date_time' => $date_time,
            'question' => $this->question,
            'q_details' => $this->q_details,
            'answer' => $this->answer,
            'field' => $this->field,
        ];
    }
}
