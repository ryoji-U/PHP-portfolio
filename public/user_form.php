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
//$result = $instagram->getById($_GET['id']);

$id = $login_user['id'];
$username = $login_user['username'];
$email = $login_user['email'];
$top_image = $login_user['top_image'];

//$instagram->userDataUpload();

?>
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
    <title>udastagram</title>
</head>
<body>
<section id="user_formphp">
	<h2>ユーザー情報編集フォーム</h2>
    <section class="spacer_30"></section>   

    <h3>現在のトップ画像:</h3>
	<span class="top_image"><img src="<?php echo $top_image?>"></span>
    <form action="user_update.php" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $id?>">

    <p>
        <input type="hidden" name="top_image" class="text selfinput" value="<?php echo $top_image?>" readonly>
        <div class="spacer_30"></div>
        <!--新しい画像を挿入する場合-->
        <h3>トップ画像を編集する場合は入力してください。</h3>
        <div id="drag-drop-area">
            <div class="drag-drop-inside">
                <p class="drag-drop-info">ここにファイルをドロップ</p>
                <p class="drag-drop-buttons">
                    <input id="fileSize" type="file" value="ファイルを選択" class="hidden" name="top_file2" accept="image/*;capture=camera">
                </p>
                <div id="previewArea"></div>
            </div>
        </div>
    <section class="spacer_30"></section>

        <!--スマホ版画像挿入方法-->
        <div id="drag-drop-areaSP">
            <input id="fileSizeSP" type="file" value="ファイルを選択" class="hidden" name="top_fileSP2" multiple="multiple" accept="image/*;capture=camera">
            <div id="previewAreaSP"></div>
        </div>
	</p>
    <section class="spacer_30"></section>

	<p>
        <h3><label for="username">ユーザー名：</label></h3>
        <input type="text" name="username" class="text selfinput" value="<?php echo $username?>">
	</p>
    <section class="spacer_30"></section>
	
	<p>
        <h3><label for="email">メールアドレス：</label></h3>
        <input type="email" name="email" class="text selfinput" value="<?php echo $email?>">
    </p>
    <section class="spacer_30"></section>
    
	<p>
        <h3><label for="password">パスワード：</label></h3>
        <input type="password" name="password" class="text selfinput">
	</p>
    <section class="spacer_30"></section>
    
	<p>
        <h3><label for="password_conf">パスワード確認用：</label></h3>
        <input type="password" name="password_conf" class="text selfinput">
	</p>
    <section class="spacer_30"></section>
	
	<!--setTokenをregister.phpに送る-->
	<input type="hidden" name="csrf_token" value="<?php echo $instagram->h($instagram->setToken());?>">
	
	<p><input type="submit" value="更新" class="selfinput send-btn"></p>
	
    </form>

<section class="spacer_50"></section>
<div class="return-btn"><a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>
<section class="spacer_50"></section>

</section>

<script src="../js/user_topImage.js"></script>
<script src="../js/user_topImageSP.js"></script>

</body>
</html>