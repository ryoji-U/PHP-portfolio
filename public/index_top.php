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

$login_user = $_SESSION['login_user'];

/*******************************/

require_once ('../header.php');

$instagram = new Instagram();

//$instagram_data = $instagram->getByYear(date("Y"));
$instagram_data = $instagram->getByYearMonth($_GET['year'],$_GET['month']);

//最新の投稿を一番上に表示するためのソート
rsort($instagram_data);
$post = $instagram_data;


//一月前
$month0 = $_GET['month']-1;
$month0 = "0".$month0;
$instagram_data_prev = $instagram->getByYearMonth($_GET['year'],$month0);

//最新の投稿を一番上に表示するためのソート
rsort($instagram_data_prev);
$post_prev = $instagram_data_prev;



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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js" defer></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


</head>
<body>
<section id="indexphp">

<section class="year-transition">
	<div class="year <?php if($_GET['year'] == 2020)echo 'action-year'?>"><a href="./index.php?year=2020&month=<?php echo $_GET['month']?>">2020年</a></div>
	<div class="year <?php if($_GET['year'] == 2021)echo 'action-year'?>"><a href="./index.php?year=2021&month=<?php echo $_GET['month']?>">2021年</a></div>
	<div class="year <?php if($_GET['year'] == 2022)echo 'action-year'?>"><a href="./index.php?year=2022&month=<?php echo $_GET['month']?>">2022年</a></div>
</section>
<section class="year-transition">
	<div class="year <?php if($_GET['month'] == 1)echo 'action-year'?>"><a href="./index.php?year=<?php echo $_GET['year']?>&month=01">1月</a></div>
	<div class="year <?php if($_GET['month'] == 2)echo 'action-year'?>"><a href="./index.php?year=<?php echo $_GET['year']?>&month=02">2月</a></div>
	<div class="year <?php if($_GET['month'] == 3)echo 'action-year'?>"><a href="./index.php?year=<?php echo $_GET['year']?>&month=03">3月</a></div>
	<div class="year <?php if($_GET['month'] == 4)echo 'action-year'?>"><a href="./index.php?year=<?php echo $_GET['year']?>&month=04">4月</a></div>
	<div class="year <?php if($_GET['month'] == 5)echo 'action-year'?>"><a href="./index.php?year=<?php echo $_GET['year']?>&month=05">5月</a></div>
	<div class="year <?php if($_GET['month'] == 6)echo 'action-year'?>"><a href="./index.php?year=<?php echo $_GET['year']?>&month=06">6月</a></div>
	<div class="year <?php if($_GET['month'] == 7)echo 'action-year'?>"><a href="./index.php?year=<?php echo $_GET['year']?>&month=07">7月</a></div>
	<div class="year <?php if($_GET['month'] == 8)echo 'action-year'?>"><a href="./index.php?year=<?php echo $_GET['year']?>&month=08">8月</a></div>
	<div class="year <?php if($_GET['month'] == 9)echo 'action-year'?>"><a href="./index.php?year=<?php echo $_GET['year']?>&month=09">9月</a></div>
	<div class="year <?php if($_GET['month'] == 10)echo 'action-year'?>"><a href="./index.php?year=<?php echo $_GET['year']?>&month=10">10月</a></div>
	<div class="year <?php if($_GET['month'] == 11)echo 'action-year'?>"><a href="./index.php?year=<?php echo $_GET['year']?>&month=11">11月</a></div>
	<div class="year <?php if($_GET['month'] == 12)echo 'action-year'?>"><a href="./index.php?year=<?php echo $_GET['year']?>&month=12">12月</a></div>
</section>

<section class="insta-list-all">

<!--全ての投稿を表示-->
<?php require_once ('post_display.php');?>

</section>
<br>

<!--前の月の分-->
<p>前月投稿</p>
<section class="insta-list-all">
<?php foreach($post_prev as $column):?>
<!--投稿状況を確認-->
<?php if($instagram->h($column['publish_status']) == 1):?>

	<section class="insta-list">
		<div class="insta-content insta-title">
			
			<!--トップ画像と投稿者名を設置-->
			<?php $postUser = $instagram->postUser($column['user_id'])?>
			<!--トップ画像-->
			<div class="top_image">
				<?php if(isset($postUser[0]['top_image'])) echo "<img src=".$postUser[0]['top_image'].">"?>
			</div>
			<!--投稿者名-->
			<div class="post_user">
				<?php if(isset($postUser[0]['username'])):?>
					<?php echo $postUser[0]['username']?>
				<?php else:?>
					NoNAME
				<?php endif;?>
			</div>
			<br>

		</div>

		<!--スライドテスト-->
		<?php $postData = $instagram->getById($column['id']);?>
		<?php 
			$slideCount = 0;
			for($i=0;$i<8;$i++){
				if($postData["slide$i"]){
					$slideCount++;
				}
			}
			if($column['movie']){
				$slideCount++;
			}
		?>

		<?php if($slideCount<=1):?>	
			<div class="insta-images">
				<img src="<?php echo $instagram->h($column['slide0'])?>">
			</div><br/>
		<?php else:?>
			<div class="insta-images slider-content">
			<ul>
				<?php for($i=0;$i<$slideCount;$i++):?>
					<?php if($i == 0):?>
						<li class="slide active"><img src="<?php echo $postData["slide$i"]?>"></li>
					<?php else:?>
						<li class="slide"><img src="<?php echo $postData["slide$i"]?>"></li>
					<?php endif;?>
				<?php endfor;?>
					<?php if($column['movie']):?>
						<li class="slide"><video src="<?php echo $column["movie"]?>" controls></video></li>
					<?php endif;?>
			</ul>
			</div>
			<section class="index-btn-all">
				<?php for($i=0;$i<$slideCount;$i++):?>
					<div class="index-btn" data-option="<?php echo $i?>"><img src="<?php echo $postData["slide$i"]?>"></div>
				<?php endfor;?>
				<?php if($column['movie']):?>
					<div class="index-btn" data-option="<?php echo $i?>"><img src="../images/movie.jpg"></div>
				<?php endif;?>
			</section>
		<?php endif;?>

		<!--スライドテスト-->

		<div class="insta-content">

			<h3 class="post-title"><?php echo $instagram->h($column['title'])?><br/></h3>
			<p><?php echo nl2br($instagram->h($column['content']))?><br/></p>
			#<?php echo $instagram->h($instagram->setCategoryName($column['category']))?><br/>
			<?php echo $instagram->h($column['post_at'])?><br/>

			<section class="content-btton-all">
				
				<!--いいねボタン-->
				<div class="good-result">
				<?php $goodResult = $instagram->ckeckGood($instagram->h($column['id']),$instagram->h($login_user['id']));?>
					<?php if($goodResult == true):?>
					<sectoin class="good-btn">
						<form action="good_btn.php" method="post" class="AjaxForm">
							<input type="hidden" value="<?php echo $instagram->h($login_user['id'])?>" name="user_id">
							<input type="hidden" value="<?php echo $instagram->h($column['id'])?>" name="post_id">
							<input type="submit" value="&#xf004" class="submit good-icon">
						</form>
					</sectoin>
					<?php else:?>
					<sectoin class="good-btn">
						<form action="good_delete.php" method="post" class="AjaxForm">
							<input type="hidden" value="<?php echo $instagram->h($login_user['id'])?>" name="user_id">
							<input type="hidden" value="<?php echo $instagram->h($column['id'])?>" name="post_id">
							<input type="submit" value="&#xf004" class="submit delete-icon">
						</form>
					</sectoin>
					<?php endif;?>
				</div><!--result-->

				<a class="comment-detail" href="./comment_detail.php?id=<?php echo $column['id']?>"><i class="far fa-comments"></i></a><br/>
				<!--編集・削除ボタンは自分の投稿にのみ表示される-->
				
				<?php if($column['post_address']):?>
				<div class="address">
					<a href="https://www.google.com/maps?q=<?php echo $column['post_address'];?>" target="blank">
						<i class="fas fa-map-marker-alt"></i>
					</a>
				</div>
				<?php endif;?>

				<?php if($instagram->h($login_user['id']) == $instagram->h($column['user_id'])):?>
					<a class="updata post-updata" href="./update_form.php?id=<?php echo $column['id']?>"><i class="fas fa-pen"></i></a><br/>
					<a class="delete post-delete" href="javascript:if(confirm('本当に削除しますか？')==true) document.location='./instagram_delete.php?id=<?php echo $column['id']?>'; else alert('キャンセルされました');"><i class="fas fa-trash-alt"></i></a>
				<?php endif;?>

			</section>
		

		</div>
	</section>



<?php endif;?>
<?php endforeach;?>
</section>

<div class="return-btn"><a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>

<!--いいねボタンテスト-->
<script src="../js/good_btn.js"></script>
<!--いいねボタンテスト-->

<!--スライドテスト-->
<script src="../js/slide.js"></script>
<!--スライドテスト-->

<section class="spacer_50"></section>
</section>
</body>

</html>