<?php
// 入力処理
if(
    !isset($_POST["bookname"])||$_POST["bookname"]==""||
    !isset($_POST["bookurl"])||$_POST["bookurl"]==""||
    !isset($_POST["bookcomment"])||$_POST["bookcomment"]==""

){
    exit('必要事項が入力されていません');
}
//POSTデータ取得
$name = $_POST["bookname"];
$url = $_POST["bookurl"];
$comment = $_POST["bookcomment"];


//DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}


//データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO  gs_bm_table(id,bookname,bookurl,bookcomment,indate)
VALUES(NULL,:bookname,:bookurl,:bookcomment,sysdate())");
$stmt->bindValue(':bookname', $name, PDO::PARAM_STR);
$stmt->bindValue(':bookurl', $url, PDO::PARAM_STR);
$stmt->bindValue(':bookcomment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();

//データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //index.phpへリダイレクト
header("Location: select.php");
exit;
}
?>