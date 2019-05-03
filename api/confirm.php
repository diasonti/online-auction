<?php
require_once(__DIR__."/../core/cors.php");
require_once(__DIR__.'/../core/auth.php');

$user = $GLOBALS['user'];
unset($user->password);

$response = array();
$response['status'] = 'ok';
$response['user'] = $user;

echo json_encode($response);
