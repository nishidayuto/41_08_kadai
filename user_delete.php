<?php
session_start();

include "funcs.php";
chkSsid();


$id = filter_input( INPUT_GET, "id" );
$pdo = db_con();

$sql = "DELETE FROM gs_user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    sqlError($stmt);
} else {
    header("Location: user_select.php");
    exit;
}

?>