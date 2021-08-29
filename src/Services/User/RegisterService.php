<?php

namespace App\Services\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterService
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(private UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function __invoke(string $name, string $email, string $password): User
    {
        $user = new User($name, $email);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $this->userRepository->save($user);

        return $user;
    }
}
