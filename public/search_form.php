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

$instagram = new Instagram();

$userData = $instagram->getUserAll();
//var_dump($userData);

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
    <title>BlogForm</title>
</head>
<body>
<section id="search_formphp">

<h2>検索ページ</h2>
<section class="spacer_50"></section>

	<h3>タイトル検索</h3>
	<form action="title_search.php" method="POST">
		<input type="text" name="searchWord" class="selfinput text">
		<input type="submit" value="検索" class="search post-search">
	</form>
	
<section class="spacer_50"></section>


	<section class="date-search-all">
	<h3>年月検索</h3>
	<form action="date_search.php" method="POST">
		<input type='number' name='year' class='selfinput search-date' value='<?php echo date("Y")?>'>
		<span>年</span>
		<select name='month' class='selfinput search-date'>
			<option value='01'>01</option>
			<option value='02'>02</option>
			<option value='03'>03</option>
			<option value='04'>04</option>
			<option value='05'>05</option>
			<option value='06'>06</option>
			<option value='07'>07</option>
			<option value='08'>08</option>
			<option value='09'>09</option>
			<option value='10'>10</option>
			<option value='11'>11</option>
			<option value='12'>12</option>
		</select>
		<span>月</span>
		<br>
		<input type="submit" value="検索" class="search post-search">
	</form>
	</section>

<section class="spacer_50"></section>


	<h3>カテゴリー検索</h3>
	
	<form action="category_search.php" method="POST">
		<select name="category" class="selfinput">
			<option value='1'>グルメ</option>
			<option value='2'>観光</option>
			<option value='3'>アクティブ</option>
			<option value='4'>その他</option>
		</select>
		<br>
		<input type="submit" value="検索" class="search post-search">
	</form>

<section class="spacer_50"></section>

	<h3>いいね検索</h3>

	<a href="./good_search.php" class="search post-search good-search">検索</a>

<section class="spacer_50"></section>


	<h3>ユーザー検索</h3>
	
	<form action="user_search.php" method="POST">
		<select name="userId" class="selfinput">
			<?php foreach($userData as $user):?>
				<option value='<?php echo $user['id']?>'><?php echo $user['username']?></option>
			<?php endforeach;?>
		</select>
		<br>
		<input type="submit" value="検索" class="search post-search">
	</form>

<section class="spacer_50"></section>
	<div class="return-btn"><a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>
<section class="spacer_50"></section>
</section>
</body>
</html>