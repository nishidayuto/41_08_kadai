<?php
session_start();
include "funcs.php";
chkSsid();
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー登録</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<header>
    <?php echo $_SESSION["name"]; ?>さん　
    <?php include("menu.php"); ?>
</header>
<form method="post" action="user_insert.php">
  <div>
   <fieldset>
    <legend class="login">ユーザー登録</legend>
     <label><input type="text" name="name" placeholder="名前"></label><br>
     <label><input type="text" name="lid" placeholder="ID"></label><br>
     <label><input type="text" name="lpw" placeholder="PW"></label><br>
     <label>管理FLG：
      一般<input type="radio" name="kanri_flg" value="0">　
      管理者<input type="radio" name="kanri_flg" value="1">
    </label>
    <br>
     <!-- <label>退会FLG：<input type="text" name="life_flg"></label><br> -->
     <input type="submit" value="送信" class="submit">
    </fieldset>
  </div>
</form>
</body>
</html>