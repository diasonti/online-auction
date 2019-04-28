<?php
require_once(__DIR__."/../core/cors.php");
require_once(__DIR__."/../data/repository/LotRepository.php");

if(isset($_GET)) {

    $action = $_GET['action'];
    if($action == 'featured') {
        getFeaturedLots();
    }

} elseif (isset($_POST)) {



}

function getFeaturedLots() {
    $lots = findFeaturedLots();
    echo json_encode($lots);
    die();
}