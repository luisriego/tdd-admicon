<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetByIdController
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        if (null === $user = $this->userRepository->findOneByIdWithDQL($id)) {
            throw new NotFoundHttpException(\sprintf('User with Id: %s not found', $id));
//            return new JsonResponse(null,JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse($user->toArray(),JsonResponse::HTTP_OK);
    }
}
