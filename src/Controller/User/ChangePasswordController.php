<?php


declare(strict_types=1);

namespace App\Controller\User;

use App\Repository\UserRepository;
use App\Service\User\EncoderServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ChangePasswordController
{

    public function __construct(private UserRepository $userRepository,private EncoderServiceInterface $encoderService)
    { }

    public function __invoke(Request $request): JsonResponse
    {
        $id = $request->attributes->get('id');
        $data = \json_decode($request->getContent(), true);
        $currentPassword = $data['currentPassword'];
        $newPassword = $data['newPassword'];
        
        $user = $this->userRepository->findOneByIdOrFail($id);

        if (!$this->encoderService->checkIfPasswordIsValid($user, $currentPassword)) {
            throw new BadRequestHttpException('Invalid current password!');
        }

        $user->setPassword($this->encoderService->generateEncodedPassword($user, $newPassword));
        $this->userRepository->save($user);

        return new JsonResponse(null);
    }
}
