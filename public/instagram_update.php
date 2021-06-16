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

$instagrams = $_POST;
$files = $_FILES;
//var_dump($instagrams);
//echo "<br>";
//var_dump($files);

$instagram = new Instagram();

if($_FILES['file']['name'][0] == ""){
	for($i=0;$i<8;$i++){
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

//新しい画像が挿入されていなければ前の画像を挿入
if(empty($instagrams['slide'])){
	$instagrams['slide'] = $instagrams['beforeSlide'];
}else{
	//画像の容量とファイル名を確認
	$instagrams = $instagram->fileSize($instagrams,$files);
}
//画像が入っていない配列にはnullを入れる
for($i=7;$i>0;$i--){
	if(empty($instagrams['slide'][$i])){
		$instagrams['slide'][$i] = null;
	}
}

//画像が入っていない配列にはnullを入れる
if(empty($instagrams['post_address'])){
	$instagrams['post_address'] = null;
}

//新しい動画が挿入されていなければ前の動画を挿入
if(empty($instagrams['movie'])){
	if(empty($instagrams['beforeMovie'])){
		$instagrams['movie'] = null;
	}elseif($instagrams['beforeMovie']){
		$instagrams['movie'] = $instagrams['beforeMovie'];
	}
}else{
	//画像の容量とファイル名を確認
	$instagrams = $instagram->movieSize($instagrams,$files);
	//動画削除ボタン
	if($instagrams['video_delete'] == 1)$instagrams['movie'] = null;
}

$instagram->instagramValidate($instagrams);
//記事を生成,スライドが何枚あるかでメソッドが決まる。
$instagram->instagramUpdate($instagrams);

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
    <section id="instagram_deletephp">
<p>投稿を更新しました。<br/>確認してください。</P>
<div class="return-btn"><a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>
    
<section class="spacer_50"></section>
</body>
</html>