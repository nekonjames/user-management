<?php
class Connection {
    static function getConnection(): PDO
    {
        return new PDO(
            "mysql:host=db;dbname=user_db;charset=utf8mb4",
            "user",
            "secret",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }
}
