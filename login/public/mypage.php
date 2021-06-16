<?php

session_start();
require_once ('../../header.php');
require_once ('../classes/userLogic.php');
require_once ('../classes/functions.php');

//ログインされているか判断
$result = UserLogic::checkLogin();

if(!$result){
	$_SESSION['login_err'] = 'ユーザー登録をして、ログインをして下さい。';
	header('Location: login_form.php');
	return;
}

$login_user = $_SESSION['login_user'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>マイページ</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../..//css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/9f2e7499ce.js"></script>
</head>
<body>
<section id="mypagephp">
<section class="spacer_50"></section>
<h2>マイページ</h2>
<p>ログインユーザー：<?php echo h($login_user['username'])?></p>
<p>メールアドレス：<?php echo h($login_user['email'])?></p>

<a href="./login.php" class="selfinput send-btn">ログアウト</a>
<section class="spacer_50"></section>
</section>
</body>
</html>