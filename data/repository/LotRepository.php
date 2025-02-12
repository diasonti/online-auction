<?php
require_once(__DIR__.'/../../core/db.php');
require_once(__DIR__.'/../../data/entity/Lot.php');
require_once(__DIR__ . '/../../data/repository/BidRepository.php');

/** @var DatabaseConnector $db */
$db = $GLOBALS['db'];

function rowToLot($row) {
    $lot = new Lot();
    $lot->id = $row["id"];
    $lot->title = $row["title"];
    $lot->imageUrl = $row["image_url"];
    $lot->startingPrice = $row["starting_price"];
    $lot->description = $row["description"];
    $lot->sellerId = $row["seller_user_id"];
    $lot->buyerId = $row["buyer_user_id"];
    $lot->createdAt = $row["created_at"];
    $lot->status = $row["status"];
    $lot->startedAt = $row["started_at"];
    $lot->duration = $row["duration"];
    $lot->finishedAt = $row["finished_at"];
    $lot->bids = findBidsByLotId($lot->id);

    $lot->lastBidUserId = 0;
    $lot->lastBidAmount = $lot->startingPrice - 0.01;
    foreach ($lot->bids as $bid) {
        if($bid->amount > $lot->lastBidAmount) {
            $lot->lastBidAmount = $bid->amount;
            $lot->lastBidUserId = $bid->bidderId;
        }
    }

    if(isset($GLOBALS['user'])) {
        $lot->isLastBidMine = $lot->lastBidUserId == $GLOBALS['user']->id;
    }

    return $lot;
}

function findLotById($id) {
    global $db;
    $sql = "SELECT * FROM lot WHERE id = $id";
    $rows = $db->execute($sql);
    $lot = null;
    if($rows->num_rows == 1) {
        $row = $rows->fetch_assoc();
        $lot = rowToLot($row);
    }
    return $lot;
}

function findLotsBySellerId($sellerId) {
    global $db;
    $sql = "SELECT * FROM lot WHERE seller_user_id = $sellerId ORDER BY created_at DESC";
    $rows = $db->execute($sql);
    $lots = array();
    if($rows->num_rows == 1) {
        while($row = $rows->fetch_assoc()) {
            $lot = rowToLot($row);
            array_push($lots, $lot);
        }
    }
    return $lots;
}

function findFeaturedLots() {
    global $db;
    $sql = "SELECT * FROM lot ORDER BY created_at DESC LIMIT 6";
    $rows = $db->execute($sql);
    $lots = array();
    if($rows->num_rows > 0) {
        while($row = $rows->fetch_assoc()) {
            $lot = rowToLot($row);
            array_push($lots, $lot);
        }
    }
    return $lots;
}

function findAllLots() {
    global $db;
    $sql = "SELECT * FROM lot ORDER BY created_at DESC";
    $rows = $db->execute($sql);
    $lots = array();
    if($rows->num_rows > 0) {
        while($row = $rows->fetch_assoc()) {
            $lot = rowToLot($row);
            array_push($lots, $lot);
        }
    }
    return $lots;
}

function findLotsByCategory($category) {
    global $db;
    $sql = "SELECT * FROM lot WHERE category = '$category' ORDER BY created_at DESC";
    $rows = $db->execute($sql);
    $lots = array();
    if($rows->num_rows > 0) {
        while($row = $rows->fetch_assoc()) {
            $lot = rowToLot($row);
            array_push($lots, $lot);
        }
    }
    return $lots;
}

function findNewestLotBySellerId($id) {
    global $db;
    $sql = "SELECT * FROM lot WHERE seller_user_id = $id ORDER BY id DESC LIMIT 1";
    $rows = $db->execute($sql);
    $lot = null;
    if($rows->num_rows == 1) {
        $row = $rows->fetch_assoc();
        $lot = rowToLot($row);
    }
    return $lot;
}

/**
 * @param $lot Lot
 * @return bool|mysqli_result
 */
function saveNewLot($lot) {
    /** @var UserAccount $user */
    $user = $GLOBALS["user"];
    global $db;
    $sql = "INSERT INTO lot (title, image_url, description, created_at, status, started_at, duration, finished_at, seller_user_id, buyer_user_id, category, starting_price) VALUES ('$lot->title', '$lot->imageUrl', '$lot->description', now(), 'bidding', now(), 3600, null, $user->id, null, '$lot->category', $lot->startingPrice)";
    return $db->execute($sql);
}

function processFinishedLots() {
    if(!$GLOBALS['service_access']) {
        return;
    }
    global $db;

    $sql = "UPDATE lot SET finished_at = now(), status = 'closed' WHERE status = 'bidding' AND now() >= DATE_ADD(started_at, INTERVAL duration SECOND);";
    $db->execute($sql);

    $sql = "UPDATE lot l SET l.buyer_user_id = (COALESCE((SELECT b.bidder_user_id FROM bid b WHERE b.lot_id = l.id ORDER BY b.bid_amount DESC LIMIT 1) , 0)) WHERE l.status = 'closed' AND l.buyer_user_id IS NULL";
    $db->execute($sql);
}