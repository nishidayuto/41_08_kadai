<?php
$id =$_GET["id"];
include "funcs.php";
$pdo = db_con();


$stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

$view = "";
if ($status == false) {
    sqlError($stmt);
}else{
    redirect("select.php");
}
$row =$stmt->fetch();

?>