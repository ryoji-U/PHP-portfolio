<?php

//require_once('../../header.php');
session_start();

require_once('../classes/functions.php');

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../..//css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/9f2e7499ce.js"></script>
    <title>udastagram</title>
</head>
<body>
<section id="signup_formphp">
<section class="spacer_50"></section>
    <h2>ユーザー登録フォーム</h2>
    <form action="register.php" method="POST">
	<p>
		<label for="username">ユーザー名：</label>
        <input type="text" name="username" class="text selfinput">
	</p>
	
	<p>
		<label for="email">メールアドレス：</label>
        <input type="email" name="email" class="text selfinput">
	</p>
	
	<p>
		<label for="password">パスワード：</label>
        <input type="password" name="password" class="text selfinput">
	</p>
	
	<p>
		<label for="password_conf">パスワード確認：</label>
        <input type="password" name="password_conf" class="text selfinput">
	</p>
	
	<!--setTokenをregister.phpに送る-->
	<input type="hidden" name="csrf_token" value="<?php echo h(setToken());?>">
	
	<p><input type="submit" value="新規登録" class="selfinput send-btn"></p>
	
    </form>
	
	<a href="./login_form.php">ログインページへ</a>
<section class="spacer_50"></section>

</section>
</body>
</html>