<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\User;

use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AnUserCanChangeHisPasswordTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/users/%s/change-password';

    public function testChangePasswordAction(): void
    {
        $payload = [
            'currentPassword' => 'sasdgfasdgsdfga',
            'newPassword' => 'new-password',
        ];

        self::$baseClient->request(Request::METHOD_PUT, \sprintf(self::ENDPOINT, $this->getPeterId()), [], [], [], \json_encode($payload));

        $response = self::$baseClient->getResponse();

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
    }
}
