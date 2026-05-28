<?php
namespace App\Model;

class UserModel
{
    public function __construct(
        private \PDO $pdo
    ) {}

    public function create(string $username, string $email, string $password): bool
    {
        $preparedStatement = $this->pdo->prepare("
            INSERT INTO users (username, email, password)
            VALUES (?, ?, ?)
        ");

        return $preparedStatement->execute([$username, $email, $password]);
    }

    public function findByEmail(string $email): array|null
    {
        $preparedStatement = $this->pdo->prepare("
            SELECT * FROM users WHERE email = ?
        ");

        $preparedStatement->execute([$email]);

        return $preparedStatement->fetch() ?: null;
    }

    public function findByUsername(string $username): array|null
    {
        $preparedStatement = $this->pdo->prepare("
            SELECT * FROM users WHERE username = ?
        ");

        $preparedStatement->execute([$username]);

        return $preparedStatement->fetch() ?: null;
    }

    public function loadAll(): array
    {
        return $this->pdo->query("SELECT username, email, created_at FROM users")->fetchAll();
    }
}