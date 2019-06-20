<?php
session_start();

include "funcs.php";
chkSsid();
$pdo = db_con();


// データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();



// データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<P>';
        $view .= '<a href="user_detail.php?id='.$result["id"].'">';
        $view .= $result["name"] . "," . $result["lid"];
        $view .= '</a>';
        $view .= '　';
        $view .= '<a href="user_delete.php?id='.$result["id"].'">';
        $view .= '[ 削除 ]';
        $view .= '</a>';
        $view .= '</p>';
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
<?php echo $_SESSION["name"]; ?>さん
<?php include("menu.php"); ?>
</header>
<fieldset class="field">
<div class="list">ユーザー一覧</div>
<div>
    <div class="select"><?=$view?></div>
</div>
</fieldset>
</body>
</html>