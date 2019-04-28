<?php
require_once(__DIR__."/../core/cors.php");
if(empty($_POST) or empty($_POST["email"]) or empty($_POST["password"]) or empty($_POST["passwordConfirm"]) or empty($_POST["fullName"])) {
    echo 'error';
    die();
}

require_once(__DIR__."/../data/repository/UserAccountRepository.php");

$email = $_POST["email"];
$fullName = $_POST["fullName"];
$password = $_POST["password"];
$passwordConfirm = $_POST["passwordConfirm"];

$email = mysqli_escape_string($GLOBALS["db"]->conn, $email);
$fullName = mysqli_escape_string($GLOBALS["db"]->conn, $fullName);
$password = mysqli_escape_string($GLOBALS["db"]->conn, $password);
$passwordConfirm = mysqli_escape_string($GLOBALS["db"]->conn, $passwordConfirm);

if(!empty(findUserAccountByEmail($email))) {
    echo "email.registered";
    die();
}

if($password != $passwordConfirm) {
    echo "confirmation.error";
    die();
}

if(strlen($password) < 1) {
    echo "password.too.weak";
    die();
}

$userAccount = new UserAccount();
$userAccount->email = $email;
$userAccount->password = $password;
$userAccount->fullName = $fullName;

echo saveUserAccount($userAccount) ? 'ok' : 'error';