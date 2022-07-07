<?php

declare(strict_types=1);

namespace App\Service\Serializer\Context;

use Symfony\Component\Serializer\Context\ContextBuilderInterface;
use Symfony\Component\Serializer\Context\Normalizer\DateTimeNormalizerContextBuilder;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class SerializerContextBuilder
{
    public function getBaseContext(): ContextBuilderInterface
    {
        $contextBuilder = (new DateTimeNormalizerContextBuilder())
            ->withFormat('Y-m-d h:i:s');
        
        return $contextBuilder;
    }
    
    public function getContextForRead(): array
    {
        $contextBuilder = (new ObjectNormalizerContextBuilder())
            ->withContext($this->getBaseContext())
            ->withGroups(['read']);

        return $contextBuilder->toArray();
    }
    
    public function getContextForWrite(): array
    {
        $contextBuilder = (new ObjectNormalizerContextBuilder())
            ->withContext($this->getBaseContext())
            ->withGroups(['write']);

        return $contextBuilder->toArray();
    }
}
