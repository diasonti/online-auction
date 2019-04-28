<?php
require_once('../../core/db.php');
require_once('../../data/repository/BetRepository.php');

/** @var DatabaseConnector $db */
$db = $GLOBALS['db'];

function rowToLot($row) {
    $lot = new Lot();
    $lot->id = $row["id"];
    $lot->title = $row["title"];
    $lot->imageUrl = $row["image_url"];
    $lot->description = $row["description"];
    $lot->sellerId = $row["seller_user_id"];
    $lot->buyerId = $row["buyer_user_id"];
    $lot->createdAt = $row["created_at"];
    $lot->status = $row["status"];
    $lot->startedAt = $row["started_at"];
    $lot->duration = $row["duration"];
    $lot->finishedAt = $row["finished_at"];
    $lot->bets = findBetsByLotId($lot->id);
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