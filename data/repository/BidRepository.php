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

function findBetById($id) {
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

function findBetsByLotId($lotId) {
    global $db;
    $sql = "SELECT * FROM bid WHERE lot_id = $lotId ORDER BY created_at DESC";
    $rows = $db->execute($sql);
    $bids = array();
    if($rows->num_rows == 1) {
        while($row = $rows->fetch_assoc()) {
            $bid = rowToBid($row);
            array_push($bids, $bid);
        }
    }
    return $bids;
}