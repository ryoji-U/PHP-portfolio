<?php

/***********************************/
session_start();
require_once ('../child_classes/instagram.php');

//ログインされているか判断
$result = instagram::checkLogin();

if(!$result){
	$_SESSION['login_err'] = 'ユーザー登録をして、ログインをして下さい。';
	header('Location: ../login/public/login_form.php');
	return;
}
/*********************************/

require_once ('../header.php');

//これでもエラーがでてしまう。
//if($_GET['id'] == null || $_GET['id'] == '')

$instagram = new instagram();
$result = $instagram->getById($_GET['id']);

$login_user = $_SESSION['login_user'];

$content = $result['content'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/9f2e7499ce.js"></script>
    <title>インスタグラム</title>
</head>
<body>
<section id="comment_formphp">
<p><?php echo $content;?></p>
<div class="spacer_50"></div>
    <h2>コメントフォーム</h2>
    <form action="comment_create.php" method="POST">

		<input type ="hidden" name="user_id" value="<?php echo $instagram->h($login_user['id'])?>">

        <textarea name="content" id="content" cols="30" rows="10" class="selfinput text"></textarea>
		<br>

		<input type="hidden" name="post_id" value="<?php echo $_GET['id'];?>" readonly>
		<br>

        <input type="submit" value="送信" class="selfinput send-btn">
    </form>
	
<section class="spacer_50"></section>
<div class="return-btn"><a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>
<section class="spacer_50"></section>
</section>
</body>
</html>