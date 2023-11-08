<?php

namespace ApiDQ\Model\Service\Address;

use ApiDQ\Model\BaseModel;

class CleanHouseResponse extends BaseModel
{
    protected string $original;
    protected string $postcodeIn;
    protected HouseDetails $houseDetails;

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function setOriginal(string $original): self
    {
        $this->original = $original;
        return $this;
    }

    public function getPostcodeIn(): string
    {
        return $this->postcodeIn;
    }

    public function setPostcodeIn(string $postcodeIn): self
    {
        $this->postcodeIn = $postcodeIn;
        return $this;
    }

    public function getHouseDetails(): HouseDetails
    {
        return $this->houseDetails;
    }

    public function setHouseDetails(HouseDetails $houseDetails): self
    {
        $this->houseDetails = $houseDetails;
        return $this;
    }
}