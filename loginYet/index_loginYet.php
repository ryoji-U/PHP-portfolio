<?php 
/*******************************/
session_start();

require_once ('../child_classes/instagram.php');

/*
//ログインされているか判断
$result = Instagram::checkLogin();

if(!$result){
	$_SESSION['login_err'] = 'ユーザー登録をして、ログインをして下さい。';
	header('Location: ../login/public/login_form.php');
	return;
}

$login_user = $_SESSION['login_user'];
*/

/*******************************/

require_once ('../header_loginYet.php');

$instagram = new Instagram();

//$instagram_data = $instagram->getByYear(date("Y"));
$instagram_data = $instagram->getByYearMonth($_GET['year'],$_GET['month']);

//最新の投稿を一番上に表示するためのソート
rsort($instagram_data);
$post = $instagram_data;

//PHPバージョン確認
//phpinfo();

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

<!--<a href="http://localhost/instagram/new/public/index_top.php?year=2020&month=08">新トップページ</a>-->

<section class="year-transition">
	<div class="year <?php if($_GET['year'] == 2020)echo 'action-date action-year action-white'?>"><a href="./index_loginYet.php?year=2020&month=<?php echo $_GET['month']?>"><span>2020年</span><?php if($_GET['year'] == 2020)echo "<div class='white-ball'></div>"?></a></div>
	<div class="year <?php if($_GET['year'] == 2021)echo 'action-date action-year action-white'?>"><a href="./index_loginYet.php?year=2021&month=<?php echo $_GET['month']?>"><span>2021年</span><?php if($_GET['year'] == 2021)echo "<div class='white-ball'></div>"?></a></div>
	<div class="year <?php if($_GET['year'] == 2022)echo 'action-date action-year action-white'?>"><a href="./index_loginYet.php?year=2022&month=<?php echo $_GET['month']?>"><span>2022年</span><?php if($_GET['year'] == 2022)echo "<div class='white-ball'></div>"?></a></div>
</section>
<section class="year-transition">
	<div class="year <?php if($_GET['month'] == 1)echo 'action-date action-month'?>"><a href="./index_loginYet.php?year=<?php echo $_GET['year']?>&month=01">1月</a></div>
	<div class="year <?php if($_GET['month'] == 2)echo 'action-date action-month'?>"><a href="./index_loginYet.php?year=<?php echo $_GET['year']?>&month=02">2月</a></div>
	<div class="year <?php if($_GET['month'] == 3)echo 'action-date action-month'?>"><a href="./index_loginYet.php?year=<?php echo $_GET['year']?>&month=03">3月</a></div>
	<div class="year <?php if($_GET['month'] == 4)echo 'action-date action-month'?>"><a href="./index_loginYet.php?year=<?php echo $_GET['year']?>&month=04">4月</a></div>
	<div class="year <?php if($_GET['month'] == 5)echo 'action-date action-month'?>"><a href="./index_loginYet.php?year=<?php echo $_GET['year']?>&month=05">5月</a></div>
	<div class="year <?php if($_GET['month'] == 6)echo 'action-date action-month'?>"><a href="./index_loginYet.php?year=<?php echo $_GET['year']?>&month=06">6月</a></div>
	<div class="year <?php if($_GET['month'] == 7)echo 'action-date action-month'?>"><a href="./index_loginYet.php?year=<?php echo $_GET['year']?>&month=07">7月</a></div>
	<div class="year <?php if($_GET['month'] == 8)echo 'action-date action-month'?>"><a href="./index_loginYet.php?year=<?php echo $_GET['year']?>&month=08">8月</a></div>
	<div class="year <?php if($_GET['month'] == 9)echo 'action-date action-month'?>"><a href="./index_loginYet.php?year=<?php echo $_GET['year']?>&month=09">9月</a></div>
	<div class="year <?php if($_GET['month'] == 10)echo 'action-date action-month'?>"><a href="./index_loginYet.php?year=<?php echo $_GET['year']?>&month=10">10月</a></div>
	<div class="year <?php if($_GET['month'] == 11)echo 'action-date action-month'?>"><a href="./index_loginYet.php?year=<?php echo $_GET['year']?>&month=11">11月</a></div>
	<div class="year <?php if($_GET['month'] == 12)echo 'action-date action-month'?>"><a href="./index_loginYet.php?year=<?php echo $_GET['year']?>&month=12">12月</a></div>
</section>

<section class="insta-list-all">

<!--全ての投稿を表示-->
<?php require_once ('post_display_loginYet.php');?>

</section>

<div class="return-btn"><a href="./index_loginYet.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>

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