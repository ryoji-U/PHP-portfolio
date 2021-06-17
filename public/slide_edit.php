<?php 

/*******************************/
session_start();

require_once ('../child_classes/instagram.php');
require_once ('../child_classes/slide.php');

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
$slideClass = new Slide();

$result = $_POST;

$slides = $slideClass->getSlideId($result['post_id']);

$slideCount = 0;
for($i=0;$i<8;$i++){
    if($slides["image_$i"]){
        $slideCount++;
    }
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <title>udastagram</title>
</head>
<body>
<section id="formphp">

    <h2>スライダー編集フォーム</h2>
        <!--ユーザーID-->
        
    <div id="result1">ここに表示</div>


<section class="spacer_50"></section>

</section>


<!--<input type="file" id="text1" multiple="multiple" name="slides[]">-->

<?php for($i=0;$i<$slideCount;$i++):?>
    <input type="text" id="text<?php echo $i?>" name="slide<?php echo $i?>" value="<?php echo $slides["image_$i"]?>"><br>
<?php endfor;?>
<input type="hidden" id="slide-count" value="<?php echo $slideCount;?>">


<!--
<input type="text" id="text0" name="slide0" value="../images/sample1.jpg"><br>
<input type="text" id="text1" name="slide1" value="../images/sample2.jpg"><br>
<input type="text" id="text2" name="slide2" value="../images/sample3.jpg"><br>
<input type="text" id="text3" name="slide3" value="../images/sample4.jpg"><br>
<input type="text" id="text4" name="slide4" value="../images/sample5.jpg"><br>
-->

<!--これを送信する-->
<input type="button" value="編集" id="send">

<script src="../js/slide_get.js"></script>

</body>
</html>