<?php

namespace Recoco\Infrastructure\Api\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;

use Recoco\Infrastructure\Api\Serializer\SerializerBuilder;

class JsonSerializer
{

    public function __construct(SerializerBuilder $serializerBuilder)
    {
        $this->serializerBuilder = $serializerBuilder;
    }

    public function getSerializer()
    {

        $encoders = [
            new JsonEncoder()
        ];

        $normalizers = [
            new DateTimeNormalizer(),
            new PropertyNormalizer()
        ];

        $this->serializerBuilder->setEncoders($encoders);
        $this->serializerBuilder->setNormalizers($normalizers);

        return $this->serializerBuilder->getSerializer();
    }

}
