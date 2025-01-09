<?php

namespace ApiDQ\Tests\Resource;

use ApiDQ\Exception\Client\BuilderException;
use ApiDQ\Exception\Service\ServiceException;
use ApiDQ\Model\Service\Address\CleanHouseRequest;
use ApiDQ\Model\Service\Address\CleanRequest;
use ApiDQ\Model\Service\Address\GeoSearchRequest;
use ApiDQ\Model\Service\Address\IdSearchRequest;
use ApiDQ\Model\Service\Address\SuggestRequest;
use ApiDQ\TestUtils\Factory\TestClientFactory;
use ApiDQ\TestUtils\TestCase\AbstractResourceTestCase;
use Pock\Enum\RequestMethod;
use Psr\Http\Client\ClientExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

class AddressTest extends AbstractResourceTestCase
{

    /**
     * @throws ClientExceptionInterface
     * @throws ServiceException
     */
    public function testClean(): void
    {
        $json = <<<'EOF'
{
    "original": "москва спартаковская 10с12",
    "addressFull": "г Москва, пл Спартаковская, дом 10, строение 12",
    "address": "г Москва, пл Спартаковская",
    "postcodeIn": "",
    "postcode": "105082",
    "region": {
        "fullName": "г Москва",
        "name": "Москва",
        "type": "г",
        "codes": {
            "fias": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
            "ga": "RU0770000000000000000000000",
            "osm": "R102269",
            "gar": "1405113",
            "kladr": "7700000000000"
        }
    },
    "area": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "municipal": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "city": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "cityArea": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "settlement": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "planStructure": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "street": {
        "fullName": "пл Спартаковская",
        "name": "Спартаковская",
        "type": "пл",
        "codes": {
            "fias": "cd6717bf-1b64-4004-a042-ff1164313e7c",
            "ga": "RU0770000000000000000002733",
            "osm": "",
            "gar": "1403803",
            "kladr": "77000000000273300"
        }
    },
    "houseDetails": {
        "fullName": "дом 10, строение 12",
        "house": "10",
        "case": "",
        "build": "12",
        "liter": "",
        "lend": "",
        "constr": "",
        "stead": "",
        "flat": "",
        "office": "",
        "room": "",
        "kab": "",
        "place": "",
        "entr": "",
        "floor": "",
        "block": "",
        "pav": "",
        "sek": "",
        "abon": "",
        "munit": "",
        "codes": {
            "fias": "627869bf-9ba6-4649-9b37-0a8a85ae0fd4",
            "ga": "",
            "osm": "",
            "gar": "84131354",
            "kladr": ""
        }
    },
    "coordinates": {
        "latitude": 55.777323,
        "longitude": 37.677726
    },
    "country": {
        "name": "Россия",
        "alpha2": "RU",
        "alpha3": "RUS",
        "numeric": 643
    },
    "valid": true,
    "quality": {
        "unique": 0,
        "actuality": 0,
        "undefined": 0,
        "level": 8,
        "house": 3,
        "geo": 8
    },
    "timezone": "UTC+3"
}
EOF;
        $request = (new CleanRequest())
            ->setQuery('москва спартаковская 10с12')
            ->setCountryCode('RU');

        $mock = static::createApiMockBuilder('/v1/clean/address');
        $mock->matchMethod(RequestMethod::POST)->reply()->withBody($json);

        $client = TestClientFactory::createClient($mock->getClient());
        $response = $client->address->clean($request);
        self::assertEquals($request->getQuery(), $response->getOriginal());
        $rspJson = static::$serializer->serialize($response, 'json');
        self::assertJsonStringEqualsJsonString($json, $rspJson);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ServiceException
     */
    public function testCleanIqdq(): void
    {
        $json = <<<'EOF'
{
  "c_ischeck": "1",
  "c_index_in": "",
  "c_zipcode": "105082",
  "c_address_original": "москва спартаковская 10с12",
  "c_address_full": "г Москва, пл Спартаковская",
  "c_kladr": "",
  "c_gaCode": "",
  "c_country": "Россия",
  "c_country_iso_code": "RU",
  "c_region_name": "Москва",
  "c_region_abbr": "г",
  "c_region_fias": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
  "c_district_name": "",
  "c_district_abbr": "",
  "c_district_fias": "",
  "c_city_name": "",
  "c_city_abbr": "",
  "c_city_fias": "",
  "c_community_name": "",
  "c_community_abbr": "",
  "c_community_fias": "",
  "c_street_name": "Спартаковская",
  "c_street_abbr": "пл",
  "c_street_fias": "cd6717bf-1b64-4004-a042-ff1164313e7c",
  "c_json_kvant": {
    "fullName": "дом 10, строение 12",
    "floor": "",
    "house": "10",
    "case": "",
    "build": "12",
    "liter": "",
    "lend": "",
    "block": "",
    "pav": "",
    "flat": "",
    "office": "",
    "kab": "",
    "abon": "",
    "sek": "",
    "entr": "",
    "room": "",
    "hostel": "",
    "munit": ""
  },
  "c_house_str": "дом 10, строение 12",
  "c_addr_lost": "",
  "c_status_error": "000038",
  "c_house_error": "3",
  "c_house_error_desc": "",
  "c_kladr19": "",
  "c_gninmb": "",
  "c_okato": "",
  "c_oktmo": "",
  "c_aoguid": "",
  "c_aolevel": "8",
  "c_houseguid": "",
  "c_timezone": "",
  "c_coordinate": {
    "c_lon": 37.677688,
    "c_lat": 55.777322,
    "c_level": 8
  }
}
EOF;

        $request = (new CleanRequest())
            ->setQuery('москва спартаковская 10с12')
            ->setCountryCode('RU');

        $mock = static::createApiMockBuilder('/v1/clean/address/iqdq');
        $mock->matchMethod(RequestMethod::POST)->reply()->withBody($json);

        $client = TestClientFactory::createClient($mock->getClient());
        $response = $client->address->cleanIqdq($request);
        self::assertEquals($request->getQuery(), $response->getCAddressOriginal());
        $rspJson = static::$serializer->serialize($response, 'json');
        self::assertJsonStringEqualsJsonString($json, $rspJson);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ServiceException
     */
    public function testSuggest(): void
    {
        $json = <<<'EOF'
{
    "suggestions": [
        {
            "addressFull": "г Москва, п Вороновское, Варшавское ш",
            "address": "г Москва, п Вороновское, Варшавское ш",
            "postcode": "108830",
            "region": {
                "fullName": "г Москва",
                "name": "Москва",
                "type": "г",
                "codes": {
                    "fias": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
                    "ga": "RU0770000000000000000000000",
                    "osm": "R102269",
                    "gar": "1405113",
                    "kladr": "7700000000000"
                }
            },
            "area": {
                "fullName": "п Вороновское",
                "name": "Вороновское",
                "type": "п",
                "codes": {
                    "fias": "10409e98-eb2d-4a52-acdd-7166ca7e0e48",
                    "ga": "RU0770020000000000000000000",
                    "osm": "",
                    "gar": "1406568",
                    "kladr": "7700200000000"
                }
            },
            "municipal": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "city": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "cityArea": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "settlement": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "planStructure": {
                "fullName": "Варшавское ш",
                "name": "Варшавское",
                "type": "ш",
                "codes": {
                    "fias": "0b585cef-22ec-4f51-9105-044a49a105a3",
                    "ga": "RU0770020000000000038500000",
                    "osm": "",
                    "gar": "164152075",
                    "kladr": "77002000000038500"
                }
            },
            "street": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "houseDetails": {
                "fullName": "",
                "house": "",
                "case": "",
                "build": "",
                "liter": "",
                "lend": "",
                "constr": "",
                "stead": "",
                "flat": "",
                "office": "",
                "room": "",
                "kab": "",
                "place": "",
                "entr": "",
                "floor": "",
                "block": "",
                "pav": "",
                "sek": "",
                "abon": "",
                "munit": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "coordinates": {
                "latitude": 0,
                "longitude": 0
            },
            "country": {
                "name": "Россия",
                "alpha2": "RU",
                "alpha3": "RUS",
                "numeric": 643
            },
            "timezone": ""
        },
        {
            "addressFull": "г Москва, п Воскресенское, Варшавское ш",
            "address": "г Москва, п Воскресенское, Варшавское ш",
            "postcode": "117148",
            "region": {
                "fullName": "г Москва",
                "name": "Москва",
                "type": "г",
                "codes": {
                    "fias": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
                    "ga": "RU0770000000000000000000000",
                    "osm": "R102269",
                    "gar": "1405113",
                    "kladr": "7700000000000"
                }
            },
            "area": {
                "fullName": "п Воскресенское",
                "name": "Воскресенское",
                "type": "п",
                "codes": {
                    "fias": "f3860e12-eee7-4a1a-8ece-0d82b2ce497f",
                    "ga": "RU0770030000000000000000000",
                    "osm": "",
                    "gar": "1406398",
                    "kladr": "7700300000000"
                }
            },
            "municipal": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "city": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "cityArea": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "settlement": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "planStructure": {
                "fullName": "Варшавское ш",
                "name": "Варшавское",
                "type": "ш",
                "codes": {
                    "fias": "f783f7d9-2720-44d4-bfe4-7ea75bfe05ce",
                    "ga": "RU0770030000000000014800000",
                    "osm": "",
                    "gar": "164152077",
                    "kladr": "77003000000014800"
                }
            },
            "street": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "houseDetails": {
                "fullName": "",
                "house": "",
                "case": "",
                "build": "",
                "liter": "",
                "lend": "",
                "constr": "",
                "stead": "",
                "flat": "",
                "office": "",
                "room": "",
                "kab": "",
                "place": "",
                "entr": "",
                "floor": "",
                "block": "",
                "pav": "",
                "sek": "",
                "abon": "",
                "munit": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "coordinates": {
                "latitude": 0,
                "longitude": 0
            },
            "country": {
                "name": "Россия",
                "alpha2": "RU",
                "alpha3": "RUS",
                "numeric": 643
            },
            "timezone": ""
        },
        {
            "addressFull": "г Москва, Варшавское ш",
            "address": "г Москва, Варшавское ш",
            "postcode": "117105",
            "region": {
                "fullName": "г Москва",
                "name": "Москва",
                "type": "г",
                "codes": {
                    "fias": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
                    "ga": "RU0770000000000000000000000",
                    "osm": "R102269",
                    "gar": "1405113",
                    "kladr": "7700000000000"
                }
            },
            "area": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "municipal": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "city": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "cityArea": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "settlement": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "planStructure": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "street": {
                "fullName": "Варшавское ш",
                "name": "Варшавское",
                "type": "ш",
                "codes": {
                    "fias": "8fc06b0b-5de3-4a72-9e6f-9e0647a37a66",
                    "ga": "RU0770000000000000000000476",
                    "osm": "W25056568",
                    "gar": "1405985",
                    "kladr": "77000000000047600"
                }
            },
            "houseDetails": {
                "fullName": "",
                "house": "",
                "case": "",
                "build": "",
                "liter": "",
                "lend": "",
                "constr": "",
                "stead": "",
                "flat": "",
                "office": "",
                "room": "",
                "kab": "",
                "place": "",
                "entr": "",
                "floor": "",
                "block": "",
                "pav": "",
                "sek": "",
                "abon": "",
                "munit": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "coordinates": {
                "latitude": 55.646,
                "longitude": 37.6203
            },
            "country": {
                "name": "Россия",
                "alpha2": "RU",
                "alpha3": "RUS",
                "numeric": 643
            },
            "timezone": "UTC+3"
        },
        {
            "addressFull": "г Москва, 1-й Варшавский проезд",
            "address": "г Москва, 1-й Варшавский проезд",
            "postcode": "115201",
            "region": {
                "fullName": "г Москва",
                "name": "Москва",
                "type": "г",
                "codes": {
                    "fias": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
                    "ga": "RU0770000000000000000000000",
                    "osm": "R102269",
                    "gar": "1405113",
                    "kladr": "7700000000000"
                }
            },
            "area": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "municipal": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "city": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "cityArea": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "settlement": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "planStructure": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "street": {
                "fullName": "1-й Варшавский проезд",
                "name": "1-й Варшавский",
                "type": "проезд",
                "codes": {
                    "fias": "09ffd474-1ca8-42e1-8217-876300fd7c2c",
                    "ga": "RU0770000000000000000000474",
                    "osm": "",
                    "gar": "1404845",
                    "kladr": "77000000000047400"
                }
            },
            "houseDetails": {
                "fullName": "",
                "house": "",
                "case": "",
                "build": "",
                "liter": "",
                "lend": "",
                "constr": "",
                "stead": "",
                "flat": "",
                "office": "",
                "room": "",
                "kab": "",
                "place": "",
                "entr": "",
                "floor": "",
                "block": "",
                "pav": "",
                "sek": "",
                "abon": "",
                "munit": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "coordinates": {
                "latitude": 55.6501,
                "longitude": 37.62639999
            },
            "country": {
                "name": "Россия",
                "alpha2": "RU",
                "alpha3": "RUS",
                "numeric": 643
            },
            "timezone": "UTC+3"
        },
        {
            "addressFull": "г Москва, 2-й Варшавский проезд",
            "address": "г Москва, 2-й Варшавский проезд",
            "postcode": "115201",
            "region": {
                "fullName": "г Москва",
                "name": "Москва",
                "type": "г",
                "codes": {
                    "fias": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
                    "ga": "RU0770000000000000000000000",
                    "osm": "R102269",
                    "gar": "1405113",
                    "kladr": "7700000000000"
                }
            },
            "area": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "municipal": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "city": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "cityArea": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "settlement": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "planStructure": {
                "fullName": "",
                "name": "",
                "type": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "street": {
                "fullName": "2-й Варшавский проезд",
                "name": "2-й Варшавский",
                "type": "проезд",
                "codes": {
                    "fias": "b89718e1-8b56-4ba8-8383-5c7b596aee6c",
                    "ga": "RU0770000000000000000000475",
                    "osm": "W30706715",
                    "gar": "1404889",
                    "kladr": "77000000000047500"
                }
            },
            "houseDetails": {
                "fullName": "",
                "house": "",
                "case": "",
                "build": "",
                "liter": "",
                "lend": "",
                "constr": "",
                "stead": "",
                "flat": "",
                "office": "",
                "room": "",
                "kab": "",
                "place": "",
                "entr": "",
                "floor": "",
                "block": "",
                "pav": "",
                "sek": "",
                "abon": "",
                "munit": "",
                "codes": {
                    "fias": "",
                    "ga": "",
                    "osm": "",
                    "gar": "",
                    "kladr": ""
                }
            },
            "coordinates": {
                "latitude": 55.6442,
                "longitude": 37.63
            },
            "country": {
                "name": "Россия",
                "alpha2": "RU",
                "alpha3": "RUS",
                "numeric": 643
            },
            "timezone": "UTC+3"
        }
    ]
}
EOF;

        $request = (new SuggestRequest())
            ->setQuery('москва варш')
            ->setCountryCode('RU')
            ->setCount(5);

        $mock = static::createApiMockBuilder('/v1/suggest/address');
        $mock->matchMethod(RequestMethod::POST)->reply()->withBody($json);

        $client = TestClientFactory::createClient($mock->getClient());
        $response = $client->address->suggest($request);
        self::assertCount($request->getCount(), $response->getSuggestions());
        $rspJson = static::$serializer->serialize($response, 'json');
        self::assertJsonStringEqualsJsonString($json, $rspJson);
    }

    /**
     * @throws BuilderException
     * @throws ClientExceptionInterface
     * @throws ServiceException
     */
    public function testIdSearch(): void
    {
        $json = <<<'EOF'
{
    "original": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
    "addressFull": "г Москва",
    "address": "г Москва",
    "postcodeIn": "",
    "postcode": "101000",
    "region": {
        "fullName": "г Москва",
        "name": "Москва",
        "type": "г",
        "codes": {
            "fias": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
            "ga": "RU0770000000000000000000000",
            "osm": "R102269",
            "gar": "1405113",
            "kladr": "7700000000000"
        }
    },
    "area": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "municipal": null,
    "city": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "cityArea": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "settlement": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "planStructure": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "street": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "houseDetails": {
        "fullName": "",
        "house": "",
        "case": "",
        "build": "",
        "liter": "",
        "lend": "",
        "constr": "",
        "stead": "",
        "flat": "",
        "office": "",
        "room": "",
        "kab": "",
        "place": "",
        "entr": "",
        "floor": "",
        "block": "",
        "pav": "",
        "sek": "",
        "abon": "",
        "munit": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "coordinates": {
        "latitude": 55.754,
        "longitude": 37.62039999
    },
    "country": {
        "name": "Россия",
        "alpha2": "RU",
        "alpha3": "RUS",
        "numeric": 643
    },
    "valid": true,
    "quality": {
        "unique": 0,
        "actuality": 0,
        "undefined": 0,
        "level": 1,
        "house": 9,
        "geo": 1
    },
    "timezone": "UTC+3"
}
EOF;

        $request = (new IdSearchRequest())
            ->setQuery('0c5b2444-70a0-4932-980c-b4dc0d3f02b5')
            ->setType(IdSearchRequest::TYPE_FIAS)
            ->setCountryCode('RU');

        $mock = static::createApiMockBuilder('/v1/idsearch/address');
        $mock->matchMethod(RequestMethod::POST)->reply()->withBody($json);

        $client = TestClientFactory::createClient($mock->getClient());
        $response = $client->address->idSearch($request);
        self::assertEquals($request->getQuery(), $response->getOriginal());
        $rspJson = static::$serializer->serialize($response, 'json');
        self::assertJsonStringEqualsJsonString($json, $rspJson);
    }

    public function testGeoSearch(): void
    {
        $json = <<<'EOF'
{
    "original": "",
    "addressFull": "г Москва, ул Кожевническая, дом 7, строение 2",
    "address": "г Москва, ул Кожевническая",
    "postcodeIn": "",
    "postcode": "115114",
    "region": {
        "fullName": "г Москва",
        "name": "Москва",
        "type": "г",
        "codes": {
            "fias": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
            "ga": "RU0770000000000000000000000",
            "osm": "R102269",
            "gar": "1405113",
            "kladr": "7700000000000"
        }
    },
    "area": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "municipal": null,
    "city": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "cityArea": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "settlement": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "planStructure": {
        "fullName": "",
        "name": "",
        "type": "",
        "codes": {
            "fias": "",
            "ga": "",
            "osm": "",
            "gar": "",
            "kladr": ""
        }
    },
    "street": {
        "fullName": "ул Кожевническая",
        "name": "Кожевническая",
        "type": "ул",
        "codes": {
            "fias": "3cc02b38-c490-428d-8fe4-2bb51c627079",
            "ga": "RU0770000000000000000001488",
            "osm": "",
            "gar": "1410732",
            "kladr": "77000000000148800"
        }
    },
    "houseDetails": {
        "fullName": "дом 7, строение 2",
        "house": "7",
        "case": "",
        "build": "2",
        "liter": "",
        "lend": "",
        "constr": "",
        "stead": "",
        "flat": "",
        "office": "",
        "room": "",
        "kab": "",
        "place": "",
        "entr": "",
        "floor": "",
        "block": "",
        "pav": "",
        "sek": "",
        "abon": "",
        "munit": "",
        "codes": {
            "fias": "0dca710b-8bf9-4a88-ba0c-4e6234963f0a",
            "ga": "",
            "osm": "",
            "gar": "15524795",
            "kladr": ""
        }
    },
    "coordinates": {
        "latitude": 55.730274,
        "longitude": 37.64611399
    },
    "country": {
        "name": "Россия",
        "alpha2": "RU",
        "alpha3": "RUS",
        "numeric": 643
    },
    "valid": true,
    "quality": {
        "unique": 1,
        "actuality": 0,
        "undefined": 0,
        "level": 8,
        "house": 3,
        "geo": 8
    },
    "timezone": "UTC+3"
}
EOF;

        $request = (new GeoSearchRequest())
            ->setLatitude(55.730274)
            ->setLongitude(37.64611399)
            ->setCountryCode('RU')
            ->setAddresslevel('house')
            ->setRadius(10);

        $mock = static::createApiMockBuilder('/v1/geosearch/address');
        $mock->matchMethod(RequestMethod::POST)->reply()->withBody($json);

        $client = TestClientFactory::createClient($mock->getClient());
        $response = $client->address->geoSearch($request);
        self::assertNotNull($response->getCoordinates());
        self::assertEquals($request->getLatitude(), $response->getCoordinates()->getLatitude());
        self::assertEquals($request->getLongitude(), $response->getCoordinates()->getLongitude());
        $rspJson = static::$serializer->serialize($response, 'json');
        self::assertJsonStringEqualsJsonString($json, $rspJson);
    }

    public function testCleanHouse(): void
    {
        $json = <<<'EOF'
{
    "original": "108811, Москва г, км Киевское шоссе 22-й (п Московский), двлд. 4, стр. 2, ЭТ 8 БЛОК Г ОФ 839",
    "postcodeIn": "108811",
    "houseDetails": {
        "fullName": "дом 4, строение 2, этаж 8, офис 839, блок г",
        "house": "4",
        "case": "",
        "build": "2",
        "liter": "",
        "lend": "",
        "constr": "",
        "stead": "",
        "flat": "",
        "office": "839",
        "room": "",
        "kab": "",
        "place": "",
        "entr": "",
        "floor": "8",
        "block": "г",
        "pav": "",
        "sek": "",
        "abon": "",
        "munit": "",
        "codes": null
    }
}
EOF;

        $request = (new CleanHouseRequest())
            ->setQuery('108811, Москва г, км Киевское шоссе 22-й (п Московский), двлд. 4, стр. 2, ЭТ 8 БЛОК Г ОФ 839')
            ->setCountryCode('RU');

        $mock = static::createApiMockBuilder('/v1/clean/house');
        $mock->matchMethod(RequestMethod::POST)->reply()->withBody($json);

        $client = TestClientFactory::createClient($mock->getClient());
        $response = $client->address->cleanHouse($request);
        self::assertEquals($request->getQuery(), $response->getOriginal());
        $rspJson = static::$serializer->serialize($response, 'json');
        self::assertJsonStringEqualsJsonString($json, $rspJson);
    }
}
