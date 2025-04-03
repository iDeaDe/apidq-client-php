<?php

namespace ApiDQ\Model\Service\Address;

use ApiDQ\Model\BaseModel;

class IdSearchCenterResponse extends BaseModel
{
    /**
     * Входящая строка с адресом, которая участвовала в стандартизации
     */
    protected string $original = '';
    /**
     * Строка с разобранным и стандартизированным адресом
     */
    protected string $address = '';
    /**
     * Строка с разобранным и стандартизированным адресом вместе с домовой частью
     */
    protected string $addressFull = '';
    /**
     * Почтовый индекс найденный во входящей строке
     */
    protected string $postcodeIn = '';
    /**
     * Почтовый индекс определенный по эталонной базе в процессе стандартизации
     */
    protected string $postcode = '';
    /**
     * Регион, область
     */
    protected ?Part $region = null;
    /**
     * Район области
     */
    protected ?Part $area = null;
    protected ?Part $municipal = null;
    /**
     * Город
     */
    protected ?Part $city = null;
    /**
     * Район города
     */
    protected ?Part $cityArea = null;
    /**
     * Населенный пункт
     */
    protected ?Part $settlement = null;
    /**
     * Планировочная структура (микрорайон)
     */
    protected ?Part $planStructure = null;
    /**
     * Улица
     */
    protected ?Part $street = null;
    /**
     * Домовая часть адреса
     */
    protected ?HouseDetails $houseDetails = null;
    /**
     * Географические координаты
     */
    protected ?Coordinates $coordinates = null;
    /**
     * Страна
     */
    protected ?Country $country = null;
    /**
     * Признак корректности адреса
     */
    protected bool $valid = false;
    /**
     * Код качества адреса
     */
    protected ?Quality $quality = null;
    protected string $timezone = '';

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function setOriginal(string $original): self
    {
        $this->original = $original;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getAddressFull(): string
    {
        return $this->addressFull;
    }

    public function setAddressFull(string $addressFull): self
    {
        $this->addressFull = $addressFull;
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

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;
        return $this;
    }

    public function getRegion(): ?Part
    {
        return $this->region;
    }

    public function setRegion(?Part $region): self
    {
        $this->region = $region;
        return $this;
    }

    public function getArea(): ?Part
    {
        return $this->area;
    }

    public function setArea(?Part $area): self
    {
        $this->area = $area;
        return $this;
    }

    public function getMunicipal(): ?Part
    {
        return $this->municipal;
    }

    public function setMunicipal(?Part $municipal): self
    {
        $this->municipal = $municipal;
        return $this;
    }

    public function getCity(): ?Part
    {
        return $this->city;
    }

    public function setCity(?Part $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getCityArea(): ?Part
    {
        return $this->cityArea;
    }

    public function setCityArea(?Part $cityArea): self
    {
        $this->cityArea = $cityArea;
        return $this;
    }

    public function getSettlement(): ?Part
    {
        return $this->settlement;
    }

    public function setSettlement(?Part $settlement): self
    {
        $this->settlement = $settlement;
        return $this;
    }

    public function getPlanStructure(): ?Part
    {
        return $this->planStructure;
    }

    public function setPlanStructure(?Part $planStructure): self
    {
        $this->planStructure = $planStructure;
        return $this;
    }

    public function getStreet(): ?Part
    {
        return $this->street;
    }

    public function setStreet(?Part $street): self
    {
        $this->street = $street;
        return $this;
    }

    public function getHouseDetails(): ?HouseDetails
    {
        return $this->houseDetails;
    }

    public function setHouseDetails(?HouseDetails $houseDetails): self
    {
        $this->houseDetails = $houseDetails;
        return $this;
    }

    public function getCoordinates(): ?Coordinates
    {
        return $this->coordinates;
    }

    public function setCoordinates(?Coordinates $coordinates): self
    {
        $this->coordinates = $coordinates;
        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;
        return $this;
    }

    public function getQuality(): ?Quality
    {
        return $this->quality;
    }

    public function setQuality(?Quality $quality): self
    {
        $this->quality = $quality;
        return $this;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }
}
