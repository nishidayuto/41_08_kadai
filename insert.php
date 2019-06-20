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



// file処理
if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
    
  $file_name = $_FILES["upfile"]["name"];       //ファイル名取得
  $tmp_path  = $_FILES["upfile"]["tmp_name"];   //一時保存場所

  $extension = pathinfo($file_name, PATHINFO_EXTENSION);
  $file_name = date("YmdHis").md5(session_id()) . "." . $extension;     //同じ画像をuploadされた時に上書きされるのを防ぐためにユニーク名作成

  // FileUpload [--Start--]
  $img="";
  $file_dir_path = "upload/".$file_name;
  if ( is_uploaded_file( $tmp_path ) ) {
      if ( move_uploaded_file( $tmp_path, $file_dir_path ) ) {
          chmod( $file_dir_path, 0644 );
          // $img = '<img src="'.$file_dir_path.'">';
      } else {
          // echo "Error:アップロードできませんでした。";
      }
  }

  
}else{
  //  $img = "画像が送信されていません";
}

//DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}


//データ登録SQL作成
$sql = "INSERT INTO gs_bm_table(bookname,bookurl,bookcomment,indate,img)VALUES(:bookname,:bookurl,:bookcomment,sysdate(),:img)";
$stmt = $pdo->prepare($sql);
// $stmt = $pdo->prepare("INSERT INTO  gs_bm_table(id,bookname,bookurl,bookcomment,img,indate)
// VALUES(NULL,:bookname,:bookurl,:bookcomment,sysdate().:img)");
$stmt->bindValue(':bookname', $name, PDO::PARAM_STR);
$stmt->bindValue(':bookurl', $url, PDO::PARAM_STR);
$stmt->bindValue(':bookcomment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':img', $file_name, PDO::PARAM_STR);
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