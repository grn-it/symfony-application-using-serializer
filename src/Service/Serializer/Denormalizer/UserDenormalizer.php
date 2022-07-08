<?php

declare(strict_types=1);

namespace App\Service\Serializer\Denormalizer;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UserDenormalizer implements DenormalizerInterface
{
    public function __construct(private readonly UserRepository $userRepository) {}

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        return $this->userRepository->find($data['id']);
    }
    
    public function supportsDenormalization(mixed $data, string $type, string $format = null)
    {
        return $type === User::class;
    }
}
