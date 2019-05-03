<?php
require_once(__DIR__."/../core/cors.php");
require_once(__DIR__ . "/../core/optionalAuth.php");

$response = array();
if(isset($GLOBALS['user'])) {
    $user = $GLOBALS['user'];
    unset($user->password);
    $response['status'] = 'ok';
    $response['user'] = $user;
} else {
    $response['status'] = 'error';
    $response['error'] = 'bad.token';
}
echo json_encode($response);