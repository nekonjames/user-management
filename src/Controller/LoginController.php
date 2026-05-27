<?php
require '../Model/UserModel.php';
require '../Service/AuthService.php';
require '../Database/Connection.php';

session_start();
$userModel = new UserModel(Connection::getConnection());

$auth = new AuthService($userModel);
$result = $auth->login($_POST['email'], $_POST['password']);

if (!$result['success']) {
    $_SESSION['error'] = $result['error'];
    header("Location: ../../public/login.php");
    exit;
}

$_SESSION['user_id'] = $result['user']['id'];
header("Location: ../../public/users.php");