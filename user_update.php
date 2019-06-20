<?php
session_start();

include "funcs.php";
chkSsid();

// POSTデータ取得
$name      = filter_input( INPUT_POST, "name" );
$lid       = filter_input( INPUT_POST, "lid" );
$lpw       = filter_input( INPUT_POST, "lpw" );
$kanri_flg = filter_input( INPUT_POST, "kanri_flg" );
$life_flg  = filter_input( INPUT_POST, "life_flg" );
$id        = filter_input( INPUT_POST, "id" );

$pdo = db_con();


// データ登録SQL作成
if($lpw==""){
    $sql = "UPDATE gs_user_table SET name=:name,lid=:lid,kanri_flg=:kanri_flg,life_flg=:life_flg WHERE id=:id";
}else{
    $sql = "UPDATE gs_user_table SET name=:name,lid=:lid,lpw=:lpw,kanri_flg=:kanri_flg,life_flg=:life_flg WHERE id=:id";
}
$stmt = $pdo->prepare($sql);



if($lpw!=""){
    $stmt->bindValue(':lpw', password_hash($lpw, PASSWORD_DEFAULT), PDO::PARAM_STR);
}
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); 
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT); 
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


// ユーザー登録処理後
if ($status==false){
    sqlError($stmt);
} else {
    header("Location: user_select.php");
    exit;
}

?>