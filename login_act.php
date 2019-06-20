<?php
session_start();


// POST値取得
$lid = filter_input( INPUT_POST, "lid" );
$lpw = filter_input( INPUT_POST, "lpw" );



// DB接続
try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('データベースに接続できませんでした。'.$e->getMessage());
    }


//データ登録SQL作成
$sql = "SELECT * FROM gs_user_table WHERE lid=:lid AND life_flg=0";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid);
// $status = $stmt->execute();
$res = $stmt->execute();


//3. SQL実行時にエラーがある場合STOP
if($res==false){
    sqlError($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
// $count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
if(password_verify($lpw, $val["lpw"]) ){ 
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  header("Location: select.php");      //Locationのあとは必ず半角スペースが必要
}else{
  //Login失敗時(Logout経由)
  header("Location: logout.php");
}
exit();




?>