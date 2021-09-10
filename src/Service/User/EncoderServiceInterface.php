<?php

declare(strict_types=1);

namespace App\Service\User;

use Symfony\Component\Security\Core\User\UserInterface;

interface EncoderServiceInterface
{
    public function generateEncodedPassword(UserInterface $user, string $password): string;

    public function checkIfPasswordIsValid(UserInterface $user, string $password): bool;
}
