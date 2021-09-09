<?php

namespace App\Services\User;

use App\Entity\User;
use App\Http\DTO\RegisterRequest;
use App\Repository\UserRepository;

class RegisterService
{
    public function __construct(private UserRepository $userRepository, private EncoderService  $encoderService)
    { }

    public function __invoke(RegisterRequest $request): User
    {
        $user = new User($request->getName(), $request->getEmail());
        $user->setPassword($this->encoderService->generateEncodedPassword($user, $request->getPassword()));

        $this->userRepository->save($user);

        return $user;
    }
}