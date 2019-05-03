<?php
require_once(__DIR__.'/../../core/db.php');
require_once(__DIR__ . '/../../data/entity/Bid.php');

/** @var DatabaseConnector $db */
$db = $GLOBALS['db'];

function rowToBid($row) {
    $bid = new Bid();
    $bid->id = $row['id'];
    $bid->createdAt = $row['created_at'];
    $bid->bidderId = $row['bidder_user_id'];
    $bid->lotId = $row['lot_id'];
    $bid->amount = $row['bid_amount'];
    return $bid;
}

function findBidById($id) {
    global $db;
    $sql = "SELECT * FROM bid WHERE id = $id";
    $rows = $db->execute($sql);
    $bid = null;
    if($rows->num_rows == 1) {
        $row = $rows->fetch_assoc();
        $bid = rowToBid($row);
    }
    return $bid;
}

function findBidsByLotId($lotId) {
    global $db;
    $sql = "SELECT * FROM bid WHERE lot_id = $lotId ORDER BY bid_amount DESC";
    $rows = $db->execute($sql);
    $bids = array();
    if(!empty($rows) and $rows->num_rows > 0) {
        while($row = $rows->fetch_assoc()) {
            $bid = rowToBid($row);
            array_push($bids, $bid);
        }
    }
    return $bids;
}

function tryToCreateBid($lotId, $bidAmount, $userId) {
    global $db;
    $sql = "INSERT INTO bid (bidder_user_id, lot_id, bid_amount) VALUES ($userId, $lotId, $bidAmount)";
    return $db->execute($sql);
}