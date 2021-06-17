<?php 
session_start();
require_once ('../header.php');
require_once ('../child_classes/instagram.php');


//ログインされているか判断
$result = Instagram::checkLogin();

if(!$result){
	$_SESSION['login_err'] = 'ユーザー登録をして、ログインをして下さい。';
	header('Location: ../login/public/login_form.php');
	return;
}

$instagram = new Instagram();
$login_user = $_SESSION['login_user'];

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
<section id="formphp">



    <h2>投稿フォーム</h2>
    <section class="spacer_30"></section>
    <form action="instagram_create.php" method="POST" enctype="multipart/form-data">
        <!--ユーザーID-->
        <input type ="hidden" name="userid" value="<?php echo $instagram->h($login_user['id'])?>">

        <!--スライド　ドラッグ&ドロップ-->
		<h3>画像：</h3>
        <div id="drag-drop-area">
            <div class="drag-drop-inside">
                <p class="drag-drop-info">ここにファイルをドロップ</p>
                <p class="drag-drop-buttons">
                    <input id="fileSize" type="file" value="ファイルを選択" class="hidden" name="file[]" multiple="multiple" accept="image/*;capture=camera">
                </p>
                <div id="previewArea"></div>
            </div>
        </div>

        <div id="drag-drop-areaSP">
            <input id="fileSizeSP" type="file" value="ファイルを選択" class="hidden" name="fileSP[]" multiple="multiple" accept="image/*;capture=camera">
            <div id="previewAreaSP"></div>
        </div>
        <section class="spacer_30"></section>

        <!--スライド　ドラッグ&ドロップ-->

        <!--動画 ドラッグ&ドロップ-->
        <!--
            <h3>動画：</h3>
        <div id="drag-drop-area-movie">
            <div class="drag-drop-inside">
                <p class="drag-drop-info">ここにファイルをドロップ</p>
                <p class="drag-drop-buttons">
                    <input id="fileSize_movie" type="file" value="ファイルを選択" class="hidden" name="video" accept="video/*;capture=camera">
                </p>
                <div id="previewArea_movie"></div>
            </div>
        </div>
        -->
        <!--動画　ドラッグ&ドロップ-->

        <h3>タイトル：</h3>
        <input type="text" name="title" class="selfinput text">
        <section class="spacer_30"></section>

        <h3>本文：</h3>
        <textarea name="content" id="content" class="selfinput text" cols="30" rows="10"></textarea>
        <section class="spacer_30"></section>

        <h3>カテゴリ：</h3>
        <select name="category" class="selfinput selectbox">
            <option value="1" class="selfinput selectbox">グルメ</option>
            <option value="2" class="selfinput selectbox">観光</option>
            <option value="3" class="selfinput selectbox">アクティブ</option>
            <option value="4" class="selfinput selectbox">その他</option>
        </select>
        <section class="spacer_30"></section>

        <h3>住所(任意)</h3>
        <input type="text" name="post_address" class="selfinput text" placeholder="〇〇県□□市△△1-1-1">
        <section class="spacer_30"></section>

        <section class="spacer_30"></section>
        <input type="radio" name="publish_status" value="1" checked class="selfinput">公開
        <input type="radio" name="publish_status" value="2" class="selfinput">下書き保存
        <section class="spacer_30"></section>
        <!--<input type="file" value="ファイルを選択" name="image">-->

        <input type="submit" value="投稿" class="selfinput send-btn">
    </form>

<section class="spacer_50"></section>
<div class="return-btn"><a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>
<section class="spacer_50"></section>

</section>


<script src="../js/slide_add.js"></script>
<script src="../js/slide_addSP.js"></script>

<!--動画　ドラッグ&ドロップ-->
<!--
<script src="../js/movie_add.js"></script>
-->
<!--動画　ドラッグ&ドロップ-->

<script>
</script>

</body>
</html>