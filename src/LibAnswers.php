<?php

declare(strict_types=1);

namespace Lits\Springshare;

use Saloon\Http\Response;

final class LibAnswers extends Connector
{
    public function chatWidgets(?int $id = null): Response
    {
        return $this->send(new Request\LibAnswers\Chat\Widgets($id));
    }

    public function queueFormFields(int $queue_id): Response
    {
        return $this->send(new Request\LibAnswers\Queue\FormFields($queue_id));
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
