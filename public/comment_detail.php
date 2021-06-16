<?php
/*これだけでもIDを表示可能
$id = $_GET['id'];
echo $id;
*/

/***********************************/
session_start();
require_once ('../child_classes/comment.php');
require_once ('../child_classes/instagram.php');

//ログインされているか判断
$result = Comment::checkLogin();

if(!$result){
	$_SESSION['login_err'] = 'ユーザー登録をして、ログインをして下さい。';
	header('Location: ../login/public/login_form.php');
	return;
}

$login_user = $_SESSION['login_user'];
/*********************************/

require_once ('../header.php');

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
<title>instagram_list</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/style.css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/9f2e7499ce.js"></script>

</head>
<body>
<section id="comment_detailphp">

<h2>コメントページ</h2>
<section class="spacer_50"></section>

<h3>本文：</h3>
<div class="comment-text"><p><?php echo nl2br($content);?></p></div>
<div class="spacer_50"></div>

<h3>コメント:</h3>

<?php if(!$result){echo ('コメントがありません。');}?>
<?php if($result):?><div class="comment-text"><?php endif;?>
<?php foreach($result as $details):?>

	<!--コメント者名を設置-->
	<?php $postUser = $comment->postUser($details['user_id']);?>
	<!--コメント者名-->
	<h3>
		<?php if(isset($postUser[0]['username'])):?>
			<?php echo $postUser[0]['username']?>
		<?php else:?>
			NoNAME
		<?php endif;?>
	</h3>

	<p><?php echo nl2br($details['content']);?></p>

	<a class="reply-button" href="./comment_reply.php?id=<?php echo $_GET['id']?>&comment_id=<?php echo $details['id']?>">返信</a>

	<?php if($postUser[0]['username'] == $login_user['username']):?>
		<a class="delete comment-delete" href="javascript:if(confirm('本当に削除しますか？')==true) document.location='./comment_delete.php?id=<?php echo $details['id']?>&postId=<?php echo $_GET['id']?>'; else alert('キャンセルされました');">削除</a>
	<?php endif;?>
	
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
				<?php if($replyUser[0]['username'] == $login_user['username']):?>
					<a class="delete comment-delete" href="javascript:if(confirm('本当に削除しますか？')==true) document.location='./comment_reply_delete.php?id=<?php echo $reply['id']?>&postId=<?php echo $_GET['id']?>'; else alert('キャンセルされました');">削除</a>
				<?php endif;?>
			</div>
		<?php endforeach;?>
	<?php endif;?>

	<section class="spacer_30"></section>

<?php endforeach;?>
<?php if($result):?></div><?php endif;?>

<div class="spacer_50"></div>

<section id="comment_form">
	
		<h3>コメントフォーム</h3>
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

