<?php
require_once(__DIR__."/../core/cors.php");
require_once(__DIR__."/../data/repository/LotRepository.php");

if(isset($_GET)) {

    $action = $_GET['action'];
    if($action == 'featured') {
        getFeaturedLots();
    } else if($action == 'get') {
        getLot($_GET['id']);
    }

} elseif (isset($_POST)) {



}

function getFeaturedLots() {
    $lots = findFeaturedLots();
    echo json_encode($lots);
    die();
}

function getLot($id) {
    $lot = findLotById($id);
    echo json_encode($lot);
    die();
}