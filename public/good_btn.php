<?php 

session_start();
require_once ('../child_classes/instagram.php');


//ログインされているか判断
$result = Instagram::checkLogin();

if(!$result){
	$_SESSION['login_err'] = 'ユーザー登録をして、ログインをして下さい。';
	header('Location: ../login/public/login_form.php');
	return;
}

$instagram = new Instagram();
$login_user = $_SESSION['login_user'];

$postId = $_POST['post_id'];
$userId = $_POST['user_id'];

$instagram->goodbtn($postId,$userId);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/9f2e7499ce.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <title>BlogForm</title>
</head>
<body>

<sectoin class="good-btn">
	<form action="good_delete.php" method="post" class="AjaxForm">
		<input type="hidden" value="<?php echo $instagram->h($userId)?>" name="user_id">
		<input type="hidden" value="<?php echo $instagram->h($postId)?>" name="post_id">
		<input type="submit" value="&#xf004" class="submit delete-icon">
	</form>
</sectoin>

<script src="../js/good_btn.js"></script>

</body>
</html>