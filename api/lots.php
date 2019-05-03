<?php
require_once(__DIR__."/../core/cors.php");
require_once(__DIR__."/../data/repository/LotRepository.php");

if($_SERVER['REQUEST_METHOD'] === 'GET') {

    $action = $_GET['action'];
    if($action == 'featured') {
        getFeaturedLots();
    } else if($action == 'get') {
        getLot($_GET['id']);
    } else if($action == 'list') {
        if(isset($_GET['category'])) {
            getList($_GET['category']);
        } else {
            getList(null);
        }
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once(__DIR__."/../core/auth.php");
    $action = $_POST['action'];
    if($action == 'create') {
        createLot($_POST['title'], $_POST['imageUrl'], $_POST['description'], $_POST['category'], $_POST['startingPrice']);
    }

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

function getList($category) {
    $list = null;
    if(empty($category)) {
        $list = findAllLots();
    } else {
        $list = findLotsByCategory($category);
    }
    echo json_encode($list);
    die();
}

function createLot($title, $imageUrl, $description, $category, $startingPrice) {
    $lot = new Lot();
    $lot->title = $title;
    $lot->imageUrl = $imageUrl;
    $lot->description = $description;
    $lot->category = $category;
    $lot->startingPrice = $startingPrice;
    saveNewLot($lot);
    $lot = findNewestLotBySellerId($GLOBALS['user']->id);
    echo $lot->id;
    die();
}