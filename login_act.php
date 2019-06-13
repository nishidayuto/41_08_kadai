<?php
session_start();

// DB接続
try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('データベースに接続できませんでした。'.$e->getMessage());
    }


//データ登録SQL作成
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid=:lid AND lpw=:lpw AND life_flg=0");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sqlError($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
// $count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){     //空じゃなければ
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





// // データ登録SQL作成
// $lid = $_POST["lid"];
// $lpw = $_POST["lpw"];
// $sql = "SELECT * FROM gs_user_table WHERE lid=lid AND lpw=:lpw";
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':lid',$id);
// $stmt->bindValue(':lpw',$lpw);
// $res = $stmt->execute();

// if($res==false){
//     $error = $stmt->$errorInfo();
//     exit("QueryError:".$error[2]);
// }

// $val = $stmt->fetch();

// if($val["id"]!=""){
//     $_SESSION["chk_ssid"] = session_id_();
//     $_SESSION["name"] = $val['name'];
//     header("Location: select.php");
// }else{
//     header("Location: login.php");
// }
// exit();
?>