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

    public function findOneByIdWithDQL(string $id): ?User
    {
        $query = $this->getEntityManager()->createQuery('SELECT u FROM App\Entity\User u WHERE u.id = :id');
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
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
