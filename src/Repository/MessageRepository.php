<?php

namespace App\Repository;

use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Message>
 *
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function findByFromAndTo(User $from, User $to): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.from = :from')
            ->orWhere('m.to = :to')
            ->setParameter('from', $from)
            ->setParameter('to', $to)
            ->orderBy('m.createdAt')
            ->getQuery()
            ->getResult()
        ;
    }
}
