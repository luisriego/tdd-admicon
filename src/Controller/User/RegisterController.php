<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Http\DTO\RegisterRequest;
use App\Services\User\RegisterService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisterController
{
    public function __construct(private RegisterService $registerService)
    {
    }

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = $this->registerService->__invoke($request);

        return new JsonResponse($user->toArray(),Response::HTTP_CREATED);
    }
}
