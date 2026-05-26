<?php

declare(strict_types=1);

namespace Lits\Springshare;

use Saloon\Http\Response;

final class LibAnswers extends Connector
{
    public function chatWidgets(?int $id = null): Response
    {
        return $this->send(new Request\LibAnswers\Chat\Widgets($id, $this->mapperBuilder));
    }

    public function queueFormFields(int $queue_id): Response
    {
        return $this->send(new Request\LibAnswers\Queue\FormFields($queue_id));
    }

    public function raDatasetFormFields(int $dataset_id): Response
    {
        return $this->send(new Request\LibAnswers\RaDataset\FormFields($dataset_id));
    }

    /** @param array<int, int> $field */
    public function raDatasetTransaction(
        int $dataset_id,
        string $owner_email,
        ?string $internal_note = null,
        ?\DateTimeImmutable $date_time = null,
        ?string $question = null,
        ?string $q_details = null,
        ?string $answer = null,
        ?array $field = null,
    ): Response {
        return $this->send(new Request\LibAnswers\RaDataset\Transaction(
            $dataset_id,
            $owner_email,
            $internal_note,
            $date_time,
            $question,
            $q_details,
            $answer,
            $field,
        ));
    }

    /** @param array<mixed> $fields */
    public function ticketCreate(
        int $quid,
        string $pquestion,
        bool $confirm_email = false,
        array $fields = [],
    ): Response {
        return $this->send(new Request\LibAnswers\Ticket\Create(
            $quid,
            $pquestion,
            $confirm_email,
            $fields,
        ));
    }
}
