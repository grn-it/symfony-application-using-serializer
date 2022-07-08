<?php

declare(strict_types=1);

namespace App\Service\Message;

use App\Entity\Message;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class MessagePersister
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager, 
        private readonly UserRepository $userRepository,
        private readonly MessageValidator $messageValidator
    ) {}

    public function persist(Message $message): Message
    {
        $this->messageValidator->validate($message);
        
        $this->entityManager->persist($message);
        $this->entityManager->flush();
        
        return $message;
    }
}
