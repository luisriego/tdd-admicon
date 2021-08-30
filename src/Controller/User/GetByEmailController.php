<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetByEmailController
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(Request $request, string $email): JsonResponse
    {
        if (null === $user = $this->userRepository->findOneByEmailWithDQL($email)) {
//            throw new NotFoundHttpException(\sprintf('User with email %s not found', $email));
            return new JsonResponse(null,JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse($user->toArray(),JsonResponse::HTTP_OK);
    }
}
