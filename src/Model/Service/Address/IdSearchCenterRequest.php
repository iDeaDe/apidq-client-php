<?php

namespace ApiDQ\Model\Service\Address;

use ApiDQ\Model\BaseModel;

class IdSearchCenterRequest extends BaseModel
{
    protected string $query = '';
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
