<?php

namespace App\Models\Repository;

use App\Models\User;
use Core\Repository;

class UserRepository extends Repository
{
    public function getTableName(): string
    {
        return 'users';
    }

    public function checkAuth(string $email, string $password): ?User
    {
        $q = sprintf(
            "SELECT * FROM `%s` WHERE `email`=:email AND `password`=:password",
            $this->getTableName()
        );

        $stmt = $this->pdo->prepare($q);
        if (!$stmt)
            return null;

        $stmt->execute(['email' => $email, 'password' => $password]);
        $user_data = $stmt->fetch();
        return empty($user_data) ? null : new User($user_data);
    }

    public function findAll(): ?array
    {
        return $this->readAll(User::class);
    }

    public function findById(int $id): User
    {
        return $this->readById(User::class, $id);
    }

    public function updateById(string $email, int $role, int $id): ?User
    {
        $q = sprintf(
            'UPDATE `%s`
            SET `email`=:email, `role`=:role
            WHERE `id`=:id',
            $this->getTableName()
        );

        $stmt = $this->pdo->prepare($q);

        if (!$stmt)
            return null;
        $stmt->execute([
            'email' => $email, 
            'role' => $role, 
            'id' => $id
        ]);
        $user_data = $stmt->fetch();
        return empty($user_data) ? null : new User($user_data);
    }
}