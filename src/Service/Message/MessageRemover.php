<?php

declare(strict_types=1);

namespace App\Service\Message;

use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;

class MessageRemover
{
    public function __construct(private readonly EntityManagerInterface $entityManager) {}

    public function remove(Message $message): void
    {
        $this->entityManager->remove($message);
        $this->entityManager->flush();
    }
}
