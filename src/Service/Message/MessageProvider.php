<?php

declare(strict_types=1);

namespace App\Service\Message;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Symfony\Component\Security\Core\Security;

class MessageProvider
{
    public function __construct(
        private readonly Security $security,
        private readonly MessageRepository $messageRepository
    ) {}

    public function getAll(): array
    {
        return $this->messageRepository->findByFromAndTo(
            $this->security->getUser(),
            $this->security->getUser(),
        );
    }
    
    public function getOne(int $id): ?Message
    {
        return $this->messageRepository->findOneBy([
            'id' => $id,
            'from' => $this->security->getUser()
        ]);
    }
}
