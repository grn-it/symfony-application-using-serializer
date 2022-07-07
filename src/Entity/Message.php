<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read', 'write'])]
    private $from;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read', 'write'])]
    private $to;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read', 'write'])]
    private $text;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['read'])]
    private $createdAt;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['read'])]
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrom(): ?User
    {
        return $this->from;
    }

    public function setFrom(?User $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function getTo(): ?User
    {
        return $this->to;
    }

    public function setTo(?User $to): self
    {
        $this->to = $to;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Sets createdAt.
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Returns createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets updatedAt.
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Returns updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
