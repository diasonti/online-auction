<?php

require_once(__DIR__."/../core/cors.php");

if(empty($_POST) or empty($_POST["email"]) or empty($_POST["password"])) {
    echo "error";
    die();
}

require_once(__DIR__."/../data/repository/UserAccountRepository.php");

$email = $_POST["email"];
$password = $_POST["password"];

$email = mysqli_escape_string($GLOBALS["db"]->conn, $email);
$password = mysqli_escape_string($GLOBALS["db"]->conn, $password);

$userAccount = findUserAccountByEmail($email);
if(empty($userAccount) or $userAccount->password != $password) {
    echo "bad.credentials";
    die();
}

$pair = $email . ":" . $password;
$token = base64_encode($pair);
echo $token;
