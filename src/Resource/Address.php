<?php

namespace ApiDQ\Resource;

use ApiDQ\Exception\Service\ServiceException;
use ApiDQ\Model\Service\Address\CleanHouseRequest;
use ApiDQ\Model\Service\Address\CleanHouseResponse;
use ApiDQ\Model\Service\Address\CleanIqdqResponse;
use ApiDQ\Model\Service\Address\CleanRequest;
use ApiDQ\Model\Service\Address\CleanResponse;
use ApiDQ\Model\Service\Address\GeoSearchRequest;
use ApiDQ\Model\Service\Address\GeoSearchResponse;
use ApiDQ\Model\Service\Address\IdSearchRequest;
use ApiDQ\Model\Service\Address\IdSearchResponse;
use ApiDQ\Model\Service\Address\SuggestRequest;
use ApiDQ\Model\Service\Address\SuggestResponse;
use Psr\Http\Client\ClientExceptionInterface;

class Address extends AbstractResource
{
    /**
     * @param CleanRequest $cleanRequest
     * @return CleanResponse
     * @throws ClientExceptionInterface
     * @throws ServiceException
     */
    public function clean(CleanRequest $cleanRequest): CleanResponse
    {
        return $this->send(
            $this->createRequest(
                'POST',
                $this->uri->withPath('/v1/clean/address'),
                $cleanRequest,
            ),
            CleanResponse::class
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ServiceException
     */
    public function cleanHouse(CleanHouseRequest $cleanHouseRequest): CleanHouseResponse
    {
        return $this->send(
            $this->createRequest(
                'POST',
                $this->uri->withPath('/v1/clean/house'),
                $cleanHouseRequest
            ),
            CleanHouseResponse::class
        );
    }

    /**
     * @param CleanRequest $cleanRequest
     * @return CleanIqdqResponse
     * @throws ClientExceptionInterface
     * @throws ServiceException
     */
    public function cleanIqdq(CleanRequest $cleanRequest): CleanIqdqResponse
    {
        return $this->send(
            $this->createRequest(
                'POST',
                $this->uri->withPath('/v1/clean/address/iqdq'),
                $cleanRequest,
            ),
            CleanIqdqResponse::class
        );
    }

    /**
     * @param SuggestRequest $suggestRequest
     * @return SuggestResponse
     * @throws ClientExceptionInterface
     * @throws ServiceException
     */
    public function suggest(SuggestRequest $suggestRequest): SuggestResponse
    {
        return $this->send(
            $this->createRequest(
                'POST',
                $this->uri->withPath('/v1/suggest/address'),
                $suggestRequest,
            ),
            SuggestResponse::class
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ServiceException
     */
    public function idSearch(IdSearchRequest $idSearchRequest): IdSearchResponse
    {
        return $this->send(
            $this->createRequest(
                'POST',
                $this->uri->withPath('/v1/idsearch/address'),
                $idSearchRequest
            ),
            IdSearchResponse::class
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ServiceException
     */
    public function geoSearch(GeoSearchRequest $geoSearchRequest): GeoSearchResponse
    {
        return $this->send(
            $this->createRequest(
                'POST',
                $this->uri->withPath('/v1/geosearch/address'),
                $geoSearchRequest
            ),
            GeoSearchResponse::class
        );
    }
}
