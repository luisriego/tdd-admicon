<?php

namespace App\Functional\Controller\User;

use Hautelook\AliceBundle\PhpUnit\RecreateDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetUserByEmailControllerTest extends WebTestCase
{
    use RecreateDatabaseTrait;

    private const ENDPOINT = '/api/v1/users/user';

    private static ?KernelBrowser $client = null;

    public function setUp(): void
    {
        parent::setUp();

        if (null === self::$client) {
            self::$client = static::createClient();
            self::$client->setServerParameter('CONTENT_TYPE', 'application/json');
        }
    }

    public function testGetUserByEmail(): void
    {
        self::$client->request(Request::METHOD_GET, \sprintf('%s/peter@api.com', self::ENDPOINT));

        $response = self::$client->getResponse();

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        // self::assertEquals('Peter', $responseData['user']['name']);
    }

    public function testGetUserForNonExistingEmail(): void
    {
        self::$client->request(Request::METHOD_GET, \sprintf('%s/brian@api.com', self::ENDPOINT));

        $response = self::$client->getResponse();

        self::assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}
