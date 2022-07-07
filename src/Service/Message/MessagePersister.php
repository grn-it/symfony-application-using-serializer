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
        private readonly MessageValidator $validator
    ) {}

    public function persist(Message $message): Message
    {
        $from = $this->userRepository->find($message->getFrom()->getId());
        $message->setFrom($from);
        
        $to = $this->userRepository->find($message->getTo()->getId());
        $message->setTo($to);

        $this->validator->validate($message);
        
        $this->entityManager->persist($message);
        $this->entityManager->flush();
        
        return $message;
    }
}
