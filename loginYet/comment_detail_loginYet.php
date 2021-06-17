<?php
/*これだけでもIDを表示可能
$id = $_GET['id'];
echo $id;
*/

/***********************************/
session_start();
require_once ('../child_classes/comment.php');
require_once ('../child_classes/instagram.php');

/*
//ログインされているか判断
$result = Comment::checkLogin();

if(!$result){
	$_SESSION['login_err'] = 'ユーザー登録をして、ログインをして下さい。';
	header('Location: ../login/public/login_form.php');
	return;
}

$login_user = $_SESSION['login_user'];
*/
/*********************************/

require_once ('../header_loginYet.php');

$comment = new Comment();
$result = $comment->getComments($_GET['id']);

//$login_user = $result['login_user'];

//$username = $login_user['username'];


/*************↓コメントフォームのphp**************/
$instagram = new instagram();
$post_result = $instagram->getById($_GET['id']);

$content = $post_result['content'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>udastagram</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/style.css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/9f2e7499ce.js"></script>

</head>
<body>
<section id="comment_detailphp">

<h2>コメントページ</h2>
<section class="spacer_50"></section>

<!--最新の投稿を一番上に表示するためのソート-->
<?php arsort($result);?>

<h3>本文：</h3>
<div class="comment-text"><p><?php echo nl2br($content);?></p></div>
<div class="spacer_50"></div>

<h3>コメント:</h3>

<?php if(!$result){echo ('コメントがありません。');}?>
<?php if($result):?><div class="comment-text"><?php endif;?>
<?php foreach($result as $details):?>

	<!--コメント者名を設置-->
	<?php $postUser = $comment->postUser($details['user_id'])?>
	<!--投稿者名-->
	<h3>
		<?php if(isset($postUser[0]['username'])):?>
			<?php echo $postUser[0]['username']?>
		<?php else:?>
			NoNAME
		<?php endif;?>
	</h3>

	<p><?php echo nl2br($details['content']);?></p>
	
	<!--コメントに対するリプライを表示-->
	<?php $reply_all = $comment->getReply($details['id']);?>
	<?php if($reply_all):?>
		<?php foreach($reply_all as $reply):?>
			<section class="spacer_10"></section>
			<div class="reply-content">
				<?php $replyUser = $comment->replyUser($reply['user_id']);?>
			
				<h3>
					<?php if(isset($replyUser[0]['username'])):?>
						<?php echo $replyUser[0]['username']?>
					<?php else:?>
						NoNAME
					<?php endif;?>
				</h3>
				
				<p><?php echo nl2br($reply['content']);?></p>
			</div>
		<?php endforeach;?>
	<?php endif;?>

	<section class="spacer_30"></section>

<?php endforeach;?>
<?php if($result):?></div><?php endif;?>


<section class="spacer_50"></section>
<div class="return-btn"><a href="./index_loginYet.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>
<section class="spacer_50"></section>

</body>

</html>

