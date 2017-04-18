<?php

namespace Recoco\Domain\Gnavi\Criteria;

use Recoco\Domain\Gnavi\Criteria\AbstractCriteria;

class RestSearchByGnavi extends AbstractCriteria
{

    protected $input_coordinates_mode;

    protected $coordinates_mode;

    protected $latitude;

    protected $longitude;

    protected $range;

    protected $keyid;

    protected $format;

    protected $offset;
    

    public function __construct()
    {
        $this->offset = 1;
    }

    public function setInputCoordinatesMode(int $input_coordinates_mode)
    {
        $this->input_coordinates_mode = $input_coordinates_mode;

        return $this;
    }

    public function getInputCoordinatesMode()
    {
        return $this->input_coordinates_mode;
    }

    public function setCoordinatesMode(int $coordinates_mode)
    {
        $this->coordinates_mode = $coordinates_mode;

        return $this;
    }

    public function getCoordinatesMode()
    {
        return $this->coordinates_mode;
    }

    public function setLatitude(float $latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLongitude(float $longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setRange(int $range)
    {
        $this->range = $range;

        return $this;
    }

    public function getRange()
    {
        return $this->range;
    }

    public function setKeyId(string $keyid)
    {
        $this->keyid = $keyid;

        return $this;
    }

    public function getKeyid()
    {
        return $this->keyid;
    }

    public function setFormat(string $format)
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setOffset(int $offset)
    {
        $this->offset = $offset;

        return $this;
    }

    public function getOffset()
    {
        return $this->offset;
    }

}
