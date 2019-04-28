<?php

if(!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
    accessDenied();
}

$token = $_SERVER['HTTP_AUTHORIZATION'];

require_once(__DIR__.'/db.php');
require_once(__DIR__.'/../data/repository/UserAccountRepository.php');

$user = null;

function getUserByToken($token) {
    $decodedToken = base64_decode($token);
    $credentials = explode(':', $decodedToken);
    if(sizeof($credentials) != 2) {
        return null;
    }
    $email = $credentials[0];
    $password = $credentials[1];
    $userAccount = findUserAccountByEmail($email);
    if(!empty($userAccount) and $userAccount->password == $password) {
        return $userAccount;
    } else {
        return null;
    }
}

function accessDenied() {
    header('HTTP/1.0 403 Forbidden');
    echo 'Access denied';
    die();
}

function authenticate() {
    global $token;
    if(empty($token)) {
        accessDenied();
    }
    $token = mb_substr($token, 6);
    $userAccount = getUserByToken($token);
    if(!empty($userAccount)) {
        global $user;
        $user = $userAccount;
    } else {
        accessDenied();
    }
}

authenticate();
