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

$login_user = $_SESSION['login_user'];

/*********************************/

require_once ('../header.php');

$instagram = new instagram();
$result = $instagram->getById($_GET['id']);

$id = $result['id'];
$title = $result['title'];
$slide0 = $result['slide0'];
$slide1 = $result['slide1'];
$slide2 = $result['slide2'];
$slide3 = $result['slide3'];
//$slide4 = $result['slide4'];
//$slide5 = $result['slide5'];
//$slide6 = $result['slide6'];
//$slide7 = $result['slide7'];
$movie = $result['movie'];
$content = $result['content'];
$category = (int)$result['category'];
$publish_status = (int)$result['publish_status'];
$post_address = $result['post_address'];


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
    <title>BlogForm</title>
</head>
<body>
<section id="update_formphp">
    <h2>更新フォーム</h2>
    <section class="spacer_30"></section>
    <form action="instagram_update.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id?>">
    
        <!--新しい画像を挿入する場合-->
        <!--スライド　ドラッグ&ドロップ-->
        <h3>画像：</h3>
        <div id="drag-drop-area">
            <div class="drag-drop-inside">
                <p class="drag-drop-info">ここにファイルをドロップ</p>
                <p class="drag-drop-buttons">
                    <input id="fileSize" type="file" value="ファイルを選択" class="hidden" name="file[]" multiple="multiple">
                </p>
                <div id="previewArea"></div>
            </div>
        </div>

        <!--スマホ版画像挿入方法-->
        <div id="drag-drop-areaSP">
            <input id="fileSizeSP" type="file" value="ファイルを選択" class="hidden" name="fileSP[]" multiple="multiple" accept="image/*;capture=camera">
            <div id="previewAreaSP"></div>
        </div>
        <section class="spacer_30"></section>

        <!--スライド　ドラッグ&ドロップ-->
        <h3>現在の画像：</h3>
        <section id="updateArea">

            <section>
                <div class="update-slide-display"><img src="<?php echo $slide0?>"></div>
                <input type="hidden" name="beforeSlide[]" value="<?php echo $slide0?>">
            </section>

            <section>
                <?php if($slide1):?>
                    <div class="update-slide-display"><img src="<?php echo $slide1?>"></div>
                    <input type="hidden" name="beforeSlide[]" value="<?php echo $slide1?>">
                <?php endif;?>
            </section>

            <section>
                <?php if($slide2):?>
                    <div class="update-slide-display"><img src="<?php echo $slide2?>"></div>
                    <input type="hidden" name="beforeSlide[]" value="<?php echo $slide2?>">
                <?php endif;?>
            </section>

            <section>
                <?php if($slide3):?>
                    <div class="update-slide-display"><img src="<?php echo $slide3?>"></div>
                    <input type="hidden" name="beforeSlide[]" value="<?php echo $slide3?>">
                <?php endif;?>
            </section>

        </section>
        <section class="spacer_30"></section>

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

        <?php if($movie):?>
            <section>
                <div class="update-movie-display"><video src="<?php echo $movie?>" controls></video></div>
                <input type="hidden" name="beforeMovie" value="<?php echo $movie?>">
            </section>
            <div class="movie-delete">
                動画を削除しますか？
                <input type="radio" name="video_delete" value="0" class="selfinput" checked>いいえ
                <input type="radio" name="video_delete" value="1" class="selfinput">はい
            </div>
        <?php endif;?>
        <!--動画　ドラッグ&ドロップ-->

        
        <h3>タイトル：</h3>
        <input type="text" name="title" value="<?php echo $title?>" class="selfinput text">
        <section class="spacer_30"></section>

        <h3>本文：</h3>
        <textarea name="content" id="content" class="selfinput text" cols="30" rows="10"><?php echo $content?></textarea>
        <section class="spacer_30"></section>

        <h3>カテゴリ：</h3>
        <select name="category" class="selfinput selectbox">
            <option value="1" class="selfinput selectbox" <?php if($category === 1)echo "selected"?>>グルメ</option>
            <option value="2" class="selfinput selectbox" <?php if($category === 2)echo "selected"?>>観光</option>
            <option value="3" class="selfinput selectbox" <?php if($category === 3)echo "selected"?>>アクティブ</option>
            <option value="4" class="selfinput selectbox" <?php if($category === 4)echo "selected"?>>その他</option>
        </select>
        <section class="spacer_30"></section>
        
        <h3>住所(任意)</h3>
        <input type="text" name="post_address" class="selfinput text" placeholder="東京都世田谷区池尻3-1-3" value="<?php echo $post_address?>">
        <section class="spacer_30"></section>


        <input type="radio" name="publish_status" value="1" class="selfinput" <?php if($publish_status === 1)echo "checked"?>>公開
        <input type="radio" name="publish_status" value="2" class="selfinput" <?php if($publish_status === 2)echo "checked"?>>下書き保存
        <section class="spacer_30"></section>
        
        <input type="submit" value="更新" class="selfinput send-btn">
    </form>
    <div class="spacer_30"></div>

<section class="spacer_50"></section>
<div class="return-btn"><a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>
<section class="spacer_50"></section>

</section>

<section class="spacer_50"></section>
</section>

<script src="../js/slide_add.js"></script>
<script src="../js/slide_addSP.js"></script>

<!--動画　ドラッグ&ドロップ-->
<!--
<script src="../js/movie_add.js"></script>
-->
<!--動画　ドラッグ&ドロップ-->

</body>
</html>