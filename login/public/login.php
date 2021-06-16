<?php

//require_once('../../header.php');
session_start();

require_once ('../../header.php');
require_once ('../classes/userLogic.php');
//
$err = [];

//バリデーション
if(!$email = filter_input(INPUT_POST,'email')){
	$err['email'] = 'メールアドレスを入力してください。';
}

if(!$password = filter_input(INPUT_POST,'password')){
	$err['password'] = 'パスワードを入力してください。';
}

//ログイン処理
if(count($err) > 0){
	$_SESSION = $err;
	header('Location: login_form.php');
	return;
}
//else
$result = UserLogic::login($email,$password);
//ログイン失敗時の処理
if(!$result){
	header('Location: login_form.php');
	return;
}

$now_year = date('Y');
$now_month = date('m');
header("Location:../../public/index.php?year=$now_year&month=$now_month");

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ログイン画面</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../..//css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/9f2e7499ce.js"></script>
</head>
<body>
<section id="loginphp">
<section class="spacer_50"></section>
<h2>ようこそインスタグラムへ</h2>

<a href="../../public/index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>" class="selfinput send-btn">トップページ</a>
<section class="spacer_50"></section>
</section>
</body>
</html>