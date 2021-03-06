<?php

namespace App\Functional\Controller\User;

use App\Tests\Functional\FunctionalTestBase;
use Hautelook\AliceBundle\PhpUnit\RecreateDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetUserByEmailControllerTest extends FunctionalTestBase
{
    use RecreateDatabaseTrait;

    private const ENDPOINT = '/api/v1/users/user-by-email';

    public function testGetUserByEmail(): void
    {
        self::$baseClient->request(Request::METHOD_GET, \sprintf('%s/peter@api.com', self::ENDPOINT));

        $response = self::$baseClient->getResponse();

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertEquals('Peter', $responseData['user']['name']);
    }

    public function testGetUserForNonExistingEmail(): void
    {
        self::$baseClient->request(Request::METHOD_GET, \sprintf('%s/brian@api.com', self::ENDPOINT));

        $response = self::$baseClient->getResponse();

        self::assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}
