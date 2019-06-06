<?php
$name = $_POST["bookname"];
$url = $_POST["bookurl"];
$comment = $_POST["bookcomment"];
$id = $_POST["id"];

//DB接続
include "funcs.php";
$pdo = db_con();

//データ登録SQL作成
$sql = "UPDATE gs_bm_table SET bookname=:bookname,bookurl=:bookurl,bookcomment=:bookcomment WHERE id=:id;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bookname',   $name,   PDO::PARAM_STR);
$stmt->bindValue(':bookurl',    $url,    PDO::PARAM_STR);
$stmt->bindValue(':bookcomment',$comment,PDO::PARAM_STR);
$stmt->bindValue(':id',         $id,     PDO::PARAM_INT);

$status = $stmt->execute();

if ($status == false) {
    sqlError($stmt);
} else {
    header("Location: select.php");
}
?>