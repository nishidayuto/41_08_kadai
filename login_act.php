<?php
session_start();
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

// DB接続
try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('データベースに接続できませんでした。'.$e->getMessage());
    }

// データ登録SQL作成
$sql = "SELECT * FROM gs_user_table WHERE lid=lid AND lpw=:lpw";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid',$id);
$stmt->bindValue(':lpw',$lpw);
$res = $stmt->execute();

if($res==false){
    $error = $stmt->$errorInfo();
    exit("QueryError:".$error[2]);
}

$val = $stmt->fetch();

if($val["id"]!=""){
    $_SESSION["chk_ssid"] = session_id_();
    $_SESSION["name"] = $val['name'];
    header("Location:select.php");
}else{
    header("Location:login.php");
}
exit();
?>