<?php
$id =$_GET["id"];
include "funcs.php";
$pdo = db_con();


$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
}
$row =$stmt->fetch();
?>

<!-- html -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>データ登録</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post" action="update.php" class="form">
  <div class="jumbotron">
   <fieldset class="field">
    <legend class="legend">ブックマーク</legend>
     <label>書籍名：<input type="text" name="bookname" value="<?=$row["bookname"]?>"></label><br>
     <label>書籍URL：<input type="text" name="bookurl" value="<?=$row["bookurl"]?>"></label><br>
     <label>書籍コメント<textArea class="text" name="bookcomment" rows="4" cols="40" value="<?=$row["bookcomment"]?>"></textArea></label><br>
     <input type="submit" value="送信" class="button">
     <input type="hidden" name="id" value="<?=$row["id"]?>">
    </fieldset>
  </div>
</form>
</body>
</html>