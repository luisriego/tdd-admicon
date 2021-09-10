<?php

declare(strict_types=1);

namespace App\Service\User;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class EncoderService implements EncoderServiceInterface
{
      public function __construct(private UserPasswordHasherInterface $userPasswordHasher) {}

      public function generateEncodedPassword(UserInterface $user, string $password): string
      {
          return $this->userPasswordHasher->hashPassword($user, $password);
      }

      public function checkIfPasswordIsValid(UserInterface $user, string $password): bool
      {
          return $this->userPasswordHasher->isPasswordValid($user, $password);
      }
}
