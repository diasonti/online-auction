<?php
require_once(__DIR__."/../core/cors.php");

$token = 'rii';
if($_SERVER['REQUEST_METHOD'] != 'POST' or !isset($_POST['token']) or $_POST['token'] != $token) {
    header('HTTP/1.0 403 Forbidden');
    die();
}
$GLOBALS['service_access'] = true;
require_once(__DIR__."/../data/repository/LotRepository.php");

processFinishedLots();
