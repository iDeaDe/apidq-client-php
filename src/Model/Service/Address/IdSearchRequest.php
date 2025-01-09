<?php

namespace ApiDQ\Model\Service\Address;

use ApiDQ\Model\BaseModel;

class IdSearchRequest extends BaseModel
{
    public const
        TYPE_UNKNOWN = 'UNKNOWN',
        TYPE_GAR = 'GAR',
        TYPE_FIAS = 'FIAS',
        TYPE_KLADR = 'KLADR',
        TYPE_OSM = 'OSM',
        TYPE_GA = 'GA';

    protected string $query = '';
    protected string $type = self::TYPE_UNKNOWN;
    protected string $countryCode = '';

    public function getQuery(): string
    {
        return $this->query;
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
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
}
