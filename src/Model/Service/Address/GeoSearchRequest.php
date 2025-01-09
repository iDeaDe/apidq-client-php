<?php

namespace ApiDQ\Model\Service\Address;

use ApiDQ\Model\BaseModel;

class GeoSearchRequest extends BaseModel
{
    protected float $latitude = 0;
    protected float $longitude = 0;
    protected string $countryCode = '';
    protected string $addresslevel = '';
    protected int $radius = 0;

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function getAddresslevel(): string
    {
        return $this->addresslevel;
    }

    public function setAddresslevel(string $addresslevel): self
    {
        $this->addresslevel = $addresslevel;
        return $this;
    }

    public function getRadius(): int
    {
        return $this->radius;
    }

    public function setRadius(int $radius): self
    {
        $this->radius = $radius;
        return $this;
    }
}
