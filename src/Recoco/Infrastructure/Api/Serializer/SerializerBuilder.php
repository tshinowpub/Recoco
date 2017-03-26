<?php

namespace Recoco\Infrastructure\Api\Serializer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

class SerializerBuilder {

    private $encoders;
    private $normalizers;

    public function addEncoder(EncoderInterface $encoder)
    {
        $this->encoders[] = $encoder;

        return $this;
    }

    public function setEncoders($encoders)
    {
        $this->encoders = $encoders;

        return $this;
    }

    public function getEncoders()
    {
        return $this->encoders;
    }

    public function addNormalizer(AbstractObjectNormalizer $normalizer)
    {
        $this->normalizers[] = $normalizer;

        return $this;
    }

    public function setNormalizers($normalizers)
    {
        $this->normalizers = $normalizers;

        return $this;
    }

    public function getNormalizers()
    {
        return $this->normalizers;
    }

    public function getSerializer()
    {
        return new Serializer($this->normalizers, $this->encoders);
    }

}
