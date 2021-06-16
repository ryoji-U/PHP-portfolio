<?php

//require_once('../../header.php');
session_start();

$err = $_SESSION;

//更新したときにセッションを削除する
$_SESSION = array();
session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ログイン画面</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../..//css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/9f2e7499ce.js"></script>
</head>
<body>
<section id="login_formphp">
<section class="spacer_50"></section>
	
	<?php if(isset($err['login_err'])):?>
		<p><?php echo $err['login_err'];?></p>
	<?php endif;?>

	<h2>ログインフォーム</h2>
	<?php if(isset($err['msg'])):?>
		<p><?php echo $err['msg'];?></p>
	<?php endif;?>
	
	<form action="login.php" method="POST">
	
		<p>
			<label for="text">メールアドレス</label>
			<?php if(isset($err['email'])):?>
				<p><?php echo $err['email'];?></p>
			<?php endif;?>
			<input type="text" name="email" class="text selfinput">
		</p>
		
		<p>
			<label for="password">パスワード</label>
			<?php if(isset($err['password'])):?>
				<p><?php echo $err['password'];?></p>
			<?php endif;?>
			<input type="password" name="password" class="text selfinput">
		</p>
		
		<p><input type="submit" value="ログイン" class="selfinput send-btn"></p>
		
	</form>
<section class="spacer_50"></section>
</section>
</body>
</html>