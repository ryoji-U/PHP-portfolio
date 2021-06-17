<?php

//ヘッダーを表示
require_once ('../header.php');

require_once ('../child_classes/instagram.php');
//クラスを使う
$instagram = new instagram();


// 圧縮するフォルダ名
$zipName = $_GET['dl']; 
//画像ディレクトリをダウンロード
$instagram->file_downdload($zipName);



//記事を生成する。
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
    <title>udastagram</title>
</head>
<body>
<section id="instagram_createphp">
<p>投稿しました。<br/>確認してください。</P>
<div class="return-btn"><a href="./index.php?year=<?php echo date("Y")?>&month=<?php echo date("m")?>">トップへ戻る</a></div>
    
<section class="spacer_50"></section>
</section>
</body>
</html>