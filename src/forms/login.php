<?php
session_start();

require_once "../lib/service/AuthService.php";

use JetBrains\PhpStorm\NoReturn;
use lib\service\AuthService;

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header('Location: /login.php');
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

#[NoReturn] function redirect_to_login($err): void
{
    header('Location: /login.php?error='.$err);
    exit();
}

if (empty($username) || empty($password)) {
    redirect_to_login('empty fields');
}

if ($password < 8) {
    redirect_to_login('password too short');
}

AuthService::login($username, $password);
