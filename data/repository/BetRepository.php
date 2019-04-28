<?php
require_once('../../core/db.php');

/** @var DatabaseConnector $db */
$db = $GLOBALS['db'];

function rowToBet($row) {
    $bet = new Bet();
    $bet->id = $row['id'];
    $bet->createdAt = $row['created_at'];
    $bet->bidderId = $row['bidder_user_id'];
    $bet->lotId = $row['lot_id'];
    $bet->amount = $row['bid_amount'];
    return $bet;
}

function findBetById($id) {
    global $db;
    $sql = "SELECT * FROM bet WHERE id = $id";
    $rows = $db->execute($sql);
    $bet = null;
    if($rows->num_rows == 1) {
        $row = $rows->fetch_assoc();
        $bet = rowToBet($row);
    }
    return $bet;
}

function findBetsByLotId($lotId) {
    global $db;
    $sql = "SELECT * FROM bet WHERE lot_id = $lotId ORDER BY created_at DESC";
    $rows = $db->execute($sql);
    $bets = array();
    if($rows->num_rows == 1) {
        while($row = $rows->fetch_assoc()) {
            $bet = rowToBet($row);
            array_push($bets, $bet);
        }
    }
    return $bets;
}