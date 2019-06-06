<?php
// DB接続
try {
$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//データ表示SQL作成
$stmt = $pdo->prepare("SELECT*FROM gs_bm_table");
$status = $stmt->execute();

//データ表示
$view="";
if($status==false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= "<p>";
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

<!-- html -->
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
<fieldset class="field">
<div class="list">データ一覧</div>
<div>
    <div class="select"><?=$view?></div>
</div>
</fieldset>
</body>
</html>