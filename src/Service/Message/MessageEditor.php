<?php

declare(strict_types=1);

namespace App\Service\Message;

use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;

class MessageEditor
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly MessageValidator $messageValidator
    ) {}

    public function edit(Message $message, Message $editedMessage): Message
    {
        $this->messageValidator->validate($editedMessage);

        $message->setText($editedMessage->getText());
        
        $this->entityManager->flush();
        
        return $message;
    }
}
