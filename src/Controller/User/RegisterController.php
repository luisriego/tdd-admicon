<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\User;
use App\Services\User\RegisterService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class RegisterController
{
    public function __construct(private RegisterService $registerService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = \json_decode($request->getContent(), true);

        if (!\array_key_exists('name', $data)) {
            throw new BadRequestHttpException('name is mandatory');
        }

        if (!\array_key_exists('email', $data)) {
            throw new BadRequestHttpException('email is mandatory');
        }

        if (!\array_key_exists('password', $data)) {
            throw new BadRequestHttpException('password is mandatory');
        }

        $user = $this->registerService->__invoke($data['name'], $data["email"], $data["password"]);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
