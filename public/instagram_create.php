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

//ヘッダーを表示
require_once('../header.php');

//送信された値を受け取る
$instagrams = $_POST;
$files = $_FILES;
//var_dump($files);
//var_dump($instagrams);

//クラスを使う
$instagram = new Instagram();

if($_FILES['file']['name'][0] == ""){
	for($i=0;$i<4;$i++){
		if(empty($_FILES['fileSP']['name'][$i])){}else{
			$_FILES['file']['name'][$i] = $_FILES['fileSP']['name'][$i];
			$_FILES['file']['type'][$i] = $_FILES['fileSP']['type'][$i];
			$_FILES['file']['tmp_name'][$i] = $_FILES['fileSP']['tmp_name'][$i];
			$_FILES['file']['error'][$i] = $_FILES['fileSP']['error'][$i];
			$_FILES['file']['size'][$i] = $_FILES['fileSP']['size'][$i];
		}
		if(empty($instagrams['slideSP'][$i])){}else{
			$instagrams['slide'][$i] = $instagrams['slideSP'][$i];
		}
	}
	$files = $_FILES;
}

//バリデーション
$instagram->instagramValidate($instagrams);

//画像の大きさを判定
//ファイル名を日付の数字羅列に変更
$instagrams = $instagram->fileSize($instagrams,$files);

//画像が入っていない配列にはnullを入れる
for($i=7;$i>0;$i--){
	if(empty($instagrams['slide'][$i])){
		$instagrams['slide'][$i] = null;
	}else{
		//$instagrams['slide'][$i] = "../images/".$instagrams['slide'][$i];
	}
}

//住所が未入力の場合nullを入れる
if(empty($instagrams['post_address'])){
	$instagrams['post_address'] = null;
}

//動画が未入力の場合nullを入れる
if(empty($instagrams['movie'])){
	$instagrams['movie'] = null;
}else{
	$instagrams = $instagram->movieSize($instagrams,$files);
}

//記事を生成する。
$instagram->instagramCreate($instagrams);
$now_year = date('Y');
$now_month = date('m');
header("Location:./index.php?year=$now_year&month=$now_month");

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
<section id="instagram_createphp">
<p>投稿しました。<br/>確認してください。</P>
<div class="return-btn"><a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>
    
<section class="spacer_50"></section>
</section>
</body>
</html>