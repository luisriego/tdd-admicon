<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends DoctrineBaseRepository
{
    protected static function entityClass(): string
    {
        return User::class;
    }

    public function findOneByEmail(string $email): ?User
    {
        return $this->objectRepository->find($email);
    }

    public function findOneByEmailWithDQL(string $email): ?User
    {
        $query = $this->getEntityManager()->createQuery('SELECT u FROM App\Entity\User u WHERE u.email = :email');
        $query->setParameter('email', $email);

        return $query->getOneOrNullResult();
    }

    public function save(User $user): void
    {
        $this->saveEntity($user);
    }
}
