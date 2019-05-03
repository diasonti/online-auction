<?php
require_once(__DIR__."/../core/cors.php");
require_once(__DIR__."/../data/repository/LotRepository.php");

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once(__DIR__ . "/../core/optionalAuth.php");
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
    require_once(__DIR__ . "/../core/mandatoryAuth.php");
    $action = $_POST['action'];
    if($action == 'create') {
        createLot($_POST['title'], $_POST['imageUrl'], $_POST['description'], $_POST['category'], $_POST['startingPrice']);
    } else if ($action == 'bid') {
        placeBid($_POST['lotId'], $_POST['amount']);
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
    $lot->title = mysqli_escape_string($GLOBALS["db"]->conn, $title);
    $lot->imageUrl = mysqli_escape_string($GLOBALS["db"]->conn, $imageUrl);
    $lot->description = mysqli_escape_string($GLOBALS["db"]->conn, $description);
    $lot->category = mysqli_escape_string($GLOBALS["db"]->conn, $category);
    $lot->startingPrice = mysqli_escape_string($GLOBALS["db"]->conn, $startingPrice);
    if(saveNewLot($lot)) {
        $lot = findNewestLotBySellerId($GLOBALS['user']->id);
        echo $lot->id;
    } else {
        echo 'error:something.went.wrong';
    }
    die();
}

function placeBid($lotId, $amount) {
    if(tryToCreateBid($lotId, $amount, $GLOBALS['user']->id)) {
        echo 'ok';
    } else {
        echo 'error:something.went.wrong';
    }
    die();
}