<?php

namespace App\Functional\Controller\User;

use App\Tests\Functional\FunctionalTestBase;
use Hautelook\AliceBundle\PhpUnit\RecreateDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetUserByIdControllerTest extends FunctionalTestBase
{
    use RecreateDatabaseTrait;

    private const ENDPOINT = '/api/v1/users/user';

    public function testGetUserById(): void
    {
        // self::$baseClient->request(Request::METHOD_GET, '/api/v1/users/user-by-email/peter@api.com');
        // $response = self::$baseClient->getResponse();
        // $responseData = \json_decode($response->getContent(), true);
        // $id = $responseData['user']['id'];

        $id = $this->getPeterId();

        self::$baseClient->request(Request::METHOD_GET, \sprintf('%s/%s', self::ENDPOINT, $id));

        $response = self::$baseClient->getResponse();

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertEquals('Peter', $responseData['user']['name']);
    }

   public function testGetUserForNonExistingId(): void
   {
       self::$baseClient->request(Request::METHOD_GET, \sprintf('%s/123456', self::ENDPOINT));

       $response = self::$baseClient->getResponse();

       self::assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
   }
}
