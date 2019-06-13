<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form method="post" action="login_act.php">
        <fieldset>
            <legend class="login">ログイン</legend>
            <label><input type="text" name="lid" placeholder="ID"></label><br>
            <label><input type="password" name="lpw" placeholder="password"></label><br>
            <input type="submit" value="Enter" class="submit">
        </fieldset>
    </form>
</body>
</html>