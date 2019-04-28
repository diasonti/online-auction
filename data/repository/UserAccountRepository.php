<?php
require_once('../../core/db.php');

/** @var DatabaseConnector $db */
$db = $GLOBALS['db'];

function rowToUserAccount($row) {
    $userAccount = new UserAccount();
    $userAccount->id = $row['id'];
    $userAccount->email = $row['email'];
    $userAccount->password = $row['password'];
    $userAccount->fullName = $row['full_name'];
    $userAccount->birthDate = $row['birth_date'];
    return $userAccount;
}

function findUserAccountById($id) {
    global $db;
    $sql = "SELECT * FROM user_account WHERE id = $id";
    $rows = $db->execute($sql);
    $userAccount = null;
    if($rows->num_rows == 1) {
        $row = $rows->fetch_assoc();
        $userAccount = rowToUserAccount($row);
    }
    return $userAccount;
}

function findUserAccountByEmail($email) {
    global $db;
    $sql = "SELECT * FROM user_account WHERE email = $email";
    $rows = $db->execute($sql);
    $userAccount = null;
    if($rows->num_rows == 1) {
        $row = $rows->fetch_assoc();
        $userAccount = rowToUserAccount($row);
    }
    return $userAccount;
}

function saveUserAccount($userAccount) {
    global $db;
    $sql = null;
    if(empty($userAccount->id)) {
        $sql = "INSERT INTO user_account (email, password, full_name) VALUES ('$userAccount->email', '$userAccount->password', '$userAccount->fullName')";
    } else {
        $sql = "UPDATE user_account SET email = '$userAccount->email', password = '$userAccount->password', full_name = '$userAccount->fullName' WHERE id = $userAccount->id";
    }
    return $db->execute($sql);
}

