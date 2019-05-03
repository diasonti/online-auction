<?php
require_once(__DIR__."/../core/cors.php");
require_once(__DIR__ . '/../core/mandatoryAuth.php');
require_once(__DIR__."/../data/repository/UserAccountRepository.php");

if(empty($_GET["id"])) {
    getSelfProfile();
} else {
    getUserProfile($_GET["id"]);
}

function getSelfProfile() {
    $user = $GLOBALS["user"];
    getUserProfile($user->id);
}

function getUserProfile($id) {
    $user = findUserAccountById($id);
    unset($user->password);
    echo json_encode($user);
    die();
}