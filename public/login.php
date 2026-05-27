<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="../src/Controller/loginController.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <div class="nav">
        Don't have an account? <a href="register.php">Register Here</a>
    </div>
</div>

</body>
</html>