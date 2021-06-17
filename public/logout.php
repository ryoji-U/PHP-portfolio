<?php
/*******************************/

session_start();

setcookie($_COOKIE[session_name()], '', time()-1);

session_destroy();

//var_dump($_COOKIE);

/*******************************/

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/9f2e7499ce.js"></script>
    <title>udastagram</title>
</head>
<body>
<section id="search_formphp">
<section class="spacer_50"></section>

    <p>ログアウトしました。</p>

    <div class="icon-btn login-btn">
        <a href="../login/public/login_form.php"><i class="fas fa-sign-in-alt"></i>ログイン</a>
    </div>

    <section class="spacer_50"></section>
	<a href="../login/public/signup_form.php" style="display:none">新規登録はこちら</a>

    <a href="file_download.php?dl=images" style="display:none">ファイルをダウンロード</a>

</section>
</body>
</html>