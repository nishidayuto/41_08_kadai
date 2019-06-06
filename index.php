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
<form method="post" action="insert.php" class="form">
  <div class="jumbotron">
   <fieldset class="field">
    <legend class="legend">ブックマーク</legend>
     <label><input type="text" name="bookname" placeholder="書籍名"></label><br>
     <label><input type="text" name="bookurl" placeholder="書籍URL"></label><br>
     <label><textArea name="bookcomment" rows="4" cols="40" placeholder="書籍コメント" class="text"></textArea></label><br>
     <input type="submit" value="送信" class="button">
    </fieldset>
  </div>
</form>
</body>
</html>