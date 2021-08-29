<?php

namespace App\Services\User;

use App\Entity\User;
use App\Http\DTO\RegisterRequest;
use App\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterService
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(private UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function __invoke(RegisterRequest $request): User
    {
        $user = new User($request->getName(), $request->getEmail());
        $user->setPassword($this->passwordHasher->hashPassword($user, $request->getPassword()));

        $this->userRepository->save($user);

        return $user;
    }
}
