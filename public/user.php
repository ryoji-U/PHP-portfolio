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

$login_user = $_SESSION['login_user'];

$instagram = new instagram();
$post = $instagram->getByIdUnpublish($login_user['id']);

$id = $login_user['id'];
$username = $login_user['username'];
$email = $login_user['email'];
$top_image = $login_user['top_image'];


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
<section id="userphp">
<h2 class="page-title">ユーザー情報</h2>
<div class="spacer_30"></div>

<div class="top_image"><img src="<?php echo $top_image?>"></div>
<div class="user-edit-btn"><a href="./user_form.php"><i class="fas fa-pen"></i></a></div>

<p>ユーザー名：<?php echo $username?></p>
<p>メールアドレス：<?php echo $email?></p>

<div class="spacer_50"></div>


<div class="return-btn draft-post"><a href="./unpublish_post.php"><i class="fas fa-list unpublic-icon"></i>投稿下書き一覧</a></div>
<div class="spacer_50"></div>

<!--最新の投稿を一番上に表示するためのソート-->
<?php arsort($post);?>

<h3>これまでの<?php echo $username?>さんの投稿</h3>

<!--投稿があるか確認する-->
<?php 
$post_all = [];
foreach($post as $publish){
	if($publish['publish_status'] == 1){
		$post_all[] = $publish;
	}
}
?>
<?php if(empty($post_all)):?>
	<div class="spacer_50"></div>
	<p>投稿はありません。</p>
<?php endif;?>


<section class="insta-list-all">

<!--全ての投稿を表示-->
<?php require_once ('post_display.php');?>

</section>

<!--いいねボタンテスト-->
<script src="../js/good_btn.js"></script>
<!--いいねボタンテスト-->

<!--スライドテスト-->
<script src="../js/slide.js"></script>
<!--スライドテスト-->

<section class="spacer_50"></section>
<div class="return-btn"><a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>
<section class="spacer_50"></section>

</section>
</body>
</html>