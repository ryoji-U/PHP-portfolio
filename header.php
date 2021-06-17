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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <title>udastagram</title>
</head>

<body>

<section id="header-all">
	<section id="header">

		<section class="global-all">
		<section class="global">
			<section class="left-btn">
				<div class="top-btn">
					<a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">
					<img src="../logo/logo.png"></a>
				</div>
				<div class="right-btn-js">
					<i class="fas fa-bars bar-btn-js"></i>
				</div>
			</section>
			<section class="right-btn">
				<div class="search-btn user-button js_btn" id="js_search_btn">
					<a href="./search_form.php"><i class="fas fa-search"></i><br>
					<div class="header-text">検索</div></a>
				</div>
				<div class="post-btn user-button">
					<a href="./form.php"><i class="fas fa-edit"></i><br>
					<div class="header-text">投稿</div></a>
				</div>
				<div class="admin-btn user-button">
					<a href="./user.php"><i class="fas fa-user-alt"></i><br>
					<div class="header-text">ユーザー</div></a>
				</div>
				<div class="logout-btn user-button js_btn" id="js_search_btn">
					<a href="javascript:if(confirm('本当にログアウトしますか？')==true) document.location='./logout.php'; else alert('キャンセルされました');"><i class="fas fa-sign-out-alt"></i><br>
					<div class="header-text">ログアウト</div></a>
				</div>
			</section>
		</section>
			<!--カテゴリー検索のプルダウンメニュー
				<section class="post-search-btn-all-2 js_btn" id="js_serach_btn2">
				<a class="search2 post-search2" href="/instagram/new/category_search.php?category=1">グルメ</a><br/>
				<a class="search2 post-search2" href="/instagram/new/category_search.php?category=2">観光</a><br/>
				<a class="search2 post-search2" href="/instagram/new/category_search.php?category=3">アクティブ</a><br/>
				<a class="search2 post-search2" href="/instagram/new/category_search.php?category=4">その他</a><br/>
			</section>-->
		</section>
	</section>
</section>


<script src="../js/header.js"></script>

</body>

</html>