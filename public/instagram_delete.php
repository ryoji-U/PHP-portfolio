<?php

/*******************************/
session_start();

require_once ('../child_classes/instagram.php');

//ログインされているか判断
$result = Instagram::checkLogin();

if(!$result){
	$_SESSION['login_err'] = 'ユーザー登録をして、ログインをして下さい。';
	header('Location: ../login/public/login_form.php');
	return;
}

/*******************************/

require_once ('../header.php');

$instagram = new instagram();
$result = $instagram->delete($_GET['id']);
$result = $instagram->deletePostComment($_GET['id']);
$result = $instagram->deleteGood($_GET['id']);

$now_year = date('Y');
$now_month = date('m');
header("Location:./index.php?year=$now_year&month=$now_month");
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
<section id="instagram_deletephp">
<p>投稿を削除しました。<br/>確認してください。</P>
<div class="return-btn"><a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>
    
<section class="spacer_50"></section>
</section>
</body>
</html>