<?php

/***********************************/
session_start();
require_once ('../child_classes/comment.php');

//ログインされているか判断
$result = Comment::checkLogin();

if(!$result){
	$_SESSION['login_err'] = 'ユーザー登録をして、ログインをして下さい。';
	header('Location: ../login/public/login_form.php');
	return;
}
/*********************************/

require_once ('../header.php');


$comment = new Comment();
$comment->deleteComment($_GET['id']);
$comment->deleteCommentDeleteReply($_GET['id']);

$comments_id = $_GET['postId'];
header("Location:./comment_detail.php?id=$comments_id");

$now_year = date('Y');
$now_month = date('m');
//header("Location:./index.php?year=$now_year&month=$now_month");
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>instagram_list</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/style.css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/9f2e7499ce.js"></script>

</head>
<body>
<section id="comment_createphp">
<p>コメントを削除しました</p>
<div class="return-btn"><a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>

</section>
</body>
</html>
