<?php
session_start();

include "funcs.php";
chkSsid();
$id = filter_input(INPUT_GET,"id");

$pdo = db_con();


$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();


// データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    $row = $stmt->fetch();
}
?>







<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>

<!-- Head[Start] -->
<header>
    <?php echo $_SESSION["name"]; ?>さん　
    <?php include("menu.php"); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_update.php">
  <div class="jumbotron">
  
    <fieldset>
    <legend class="login">ユーザー更新</legend>
     <label>名前<input type="text" name="name" value="<?php echo $row["name"]; ?>"></label><br>
     <label>Login ID<input type="text" name="lid" value="<?php echo $row["lid"]; ?>"></label><br>
     <label>Login PW<input type="text" name="lpw" placeholder="変更あるときだけ入力"></label><br>
     <label>管理FLG：
          <?php if($row["kanri_flg"]=="0"){ ?>
              一般<input type="radio" name="kanri_flg" value="0" checked="checked">　
              管理者<input type="radio" name="kanri_flg" value="1">
          <?php }else{ ?>
              一般<input type="radio" name="kanri_flg" value="0">　
              管理者<input type="radio" name="kanri_flg" value="1" checked="checked">
          <?php } ?>
    </label>
    <br>
     <label>退会FLG：
     <?php if($row["life_flg"]=="0"){ ?>
              利用中<input type="radio" name="life_flg" value="0" checked="checked">　
              退会<input type="radio" name="life_flg" value="1">
          <?php }else{ ?>
              利用中<input type="radio" name="life_flg" value="0">　
              退会<input type="radio" name="life_flg" value="1" checked="checked">
          <?php } ?>
     </label><br>
     <input type="submit" value="更新" class="submit">
     <input type="hidden" name="id" value="<?php echo $id; ?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>