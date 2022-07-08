<?php

declare(strict_types=1);

namespace App\Service\Message;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MessageValidator
{
    public function __construct(
        private readonly Security $security,
        private readonly ValidatorInterface $validator
    ) {}

    public function validate(Message $message): void
    {
        /** @var ConstraintViolationInterface $violation */
        foreach ($this->validator->validate($message) as $violation) {
            throw new MessageValidationException($violation->getMessage());
        }
        
        $this->validateFromIsCurrentUser($message->getFrom());
    }
    
    public function validateFromIsCurrentUser(User $from): void
    {
        if ($from->getId() !== $this->security->getUser()->getId()) {
            throw new MessageValidationException('User specified in "From" is not current user');
        }
    }
}
