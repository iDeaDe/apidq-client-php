<?php

namespace ApiDQ\Tests\Resource;

use ApiDQ\Exception\Service\ServiceException;
use ApiDQ\Model\Service\Address\CleanRequest;
use ApiDQ\TestUtils\Factory\TestClientFactory;
use ApiDQ\TestUtils\TestCase\AbstractResourceTestCase;
use Pock\Enum\RequestMethod;
use Psr\Http\Client\ClientExceptionInterface;

class AbstractResourceTest extends AbstractResourceTestCase
{
    /**
     * @throws ClientExceptionInterface
     */
    public function testServiceException(): void
    {
        $json = <<<'EOF'
{
  "code": "VALIDATION_ERROR",
  "message": "Ошибка валидации",
  "description": "query: значение не может быть пустым."
}
EOF;

        $request = (new CleanRequest())
            ->setCountryCode('RU');

        $mock = static::createApiMockBuilder('/v1/clean/address');
        $mock->matchMethod(RequestMethod::POST)->reply(400)->withBody($json);

        $client = TestClientFactory::createClient($mock->getClient());
        try {
            $client->address->clean($request);
            self::fail('response returned, but need exception ServiceException');
        } catch (ServiceException $e) {
            self::assertEquals('VALIDATION_ERROR', $e->getErrorResponse()->getCode());
            self::assertEquals('Ошибка валидации', $e->getErrorResponse()->getMessage());
            self::assertEquals('query: значение не может быть пустым.', $e->getErrorResponse()->getDescription());
        }
    }
}
