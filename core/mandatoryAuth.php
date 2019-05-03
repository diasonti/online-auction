<?php

$token = null;
foreach (getallheaders() as $name => $value) {
    if($name == "Authorization") {
        global $token;
        $token = mb_substr($value, 6);
        break;
    }
}

require_once(__DIR__.'/db.php');
require_once(__DIR__.'/../data/repository/UserAccountRepository.php');

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

function authenticate($token) {
    if(empty($token)) {
        var_dump($token);
        accessDenied();
    }
    $userAccount = getUserByToken($token);
    if(!empty($userAccount)) {
        $GLOBALS["user"] = $userAccount;
    } else {
        accessDenied();
    }
}

authenticate($token);
