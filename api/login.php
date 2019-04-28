<?php

if(empty($_POST) or empty($_POST["email"]) or empty($_POST["password"])) {
    echo "500";
}

require_once("../data/repository/UserAccountRepository.php");

$email = $_POST["email"];
$password = $_POST["password"];

$email = mysqli_escape_string($GLOBALS["db"], $email);
$password = mysqli_escape_string($GLOBALS["db"], $password);

$userAccount = findUserAccountByEmail($email);
if(empty($userAccount) or $userAccount->password != $password) {
    echo "bad.credentials";
    return;
}

$pair = $email . ":" . $password;
$token = base64_encode($pair);
echo $token;
