<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();

if (empty($_SESSION['user_id'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$userService = require '../src/Service/UserService.php';

$users = $userService->loadAll();
?>

<html>
    <head>
        <title>Users</title>
        <link rel="stylesheet" href="../assets/style.css">
    </head>
    <body>

        <div class="nav">
            <a href="logout.php">Logout</a>
        </div>

        <h2 style="text-align:center;">Registered Users</h2>

        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Registered At</th>
            </tr>

            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= $user['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </body>
</html>