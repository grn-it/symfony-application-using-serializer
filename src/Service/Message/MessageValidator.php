<?php

declare(strict_types=1);

namespace App\Service\Message;

use App\Entity\Message;
use Symfony\Component\Security\Core\Security;

class MessageValidator
{
    public function __construct(private readonly Security $security) {}

    public function validate(Message $message): void
    {
        if (is_null($message->getFrom())) {
            throw new MessageValidationException('User specified in "From" not found');
        }

        if ($message->getFrom()->getId() !== $this->security->getUser()->getId()) {
            throw new MessageValidationException('User specified in "From" is not current user');
        }

        if (is_null($message->getTo())) {
            throw new MessageValidationException('User specified in "To" not found');
        }

        $this->validateText($message->getText());
    }
    
    public function validateText(string $text): void
    {
        if (empty($text)) {
            throw new MessageValidationException('Text cannot be empty');
        }
    }
}
