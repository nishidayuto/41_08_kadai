<?php
session_start();

include "funcs.php";

// 検索キーワード
$s = $_POST["s"];

$pdo = db_con();


//データ表示SQL作成
$stmt = $pdo->prepare("SELECT*FROM gs_bm_table WHERE bookname LIKE :s");
$stmt->bindValue(":s", '%'.$s.'%');
$status = $stmt->execute();

//データ表示
$view="";
if($status==false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= "<p>";
    $view .='<img src="upload/'.$result["img"].'" width="150">';
    $view .='<a href="detail.php?id='.$result["id"].'">';
    $view .=$result["id"].":".$result["bookname"].":".$result["bookurl"].":".$result["bookcomment"].":".$result["indate"];
    $view .='</a>';
    $view .=' ';
    $view .='<a href="delete.php?id='.$result["id"].'">';
    $view .="[削除]";
    $view .='</a>';
    $view .='</p>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>データ表示</title>
  <link rel="stylesheet" href="select.css">
</head>
<body>
<header>
<?php include("menu.php"); ?>
</header>
<fieldset class="field">
<div class="list">データ一覧</div>
<input type="text" id="s">
<button id="btn">検索</button>
<div class="select"><?=$view?></div>
</fieldset>
</body>
</html>