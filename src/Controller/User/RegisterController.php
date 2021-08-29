<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(private UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
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

        $user = new User($data['name'], $data['email']);
        $user->setPassword($this->passwordHasher->hashPassword($user, $data['password']));

        $this->userRepository->save($user);

        return new JsonResponse(null, JsonResponse::HTTP_CREATED);
    }
}
