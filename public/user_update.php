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

$userdata = $_POST;
$files = $_FILES;
//var_dump($files);
//echo "<br>";
//var_dump($userdata);

$login_user = $_SESSION['login_user'];

$instagram = new Instagram();

if(empty($userdata['top_image2'])){
}elseif($_FILES['top_file2']['name'] == ""){
	if(empty($_FILES['top_fileSP2']['name'])){}else{
		$_FILES['top_file2']['name'] = $_FILES['top_fileSP2']['name'];
		$_FILES['top_file2']['type'] = $_FILES['top_fileSP2']['type'];
		$_FILES['top_file2']['tmp_name'] = $_FILES['top_fileSP2']['tmp_name'];
		$_FILES['top_file2']['error'] = $_FILES['top_fileSP2']['error'];
		$_FILES['top_file2']['size'] = $_FILES['top_fileSP2']['size'];
	}
	$files = $_FILES;
}

//$userdata['top_image'] = $instagram->topImageChoice($userdata);
if(empty($userdata['top_image2'])){
}else{
	$userdata = $instagram->fileSizeUser($userdata,$files);
	$userdata['top_image'] = $userdata['top_image2'];
}

$instagram->userDataValidate($userdata);
if(empty($userdata['password'])){
	//パスワードが無い場合のメソッド
	$instagram->userDataUpdateNopass($userdata);
}else{
	//パスワードがある場合のメソッド
	$instagram->userDataUpdate($userdata);
}


//ユーザー情報を更新後、セッションの値を更新する。
$test = $instagram->userDataUpload($login_user['id']);
$_SESSION['login_user'] = $test[0];
//var_dump($_SESSION['login_user']);



//ここから下はregister.phpのもの
//↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓

//require_once ('../classes/userLogic.php');

//エラーメッセージ（エラーを溜める）
$err = [];

$token = filter_input(INPUT_POST,'csrf_token');
//トークンが無い、もしくは一致しない場合、処理を中止する。
//二重送信とURLを直接たたいてページに遷移されることを防ぐ。
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
	exit('不正なリクエスト');
}

unset($_SESSION['csrf_token']);
/*
//バリデーション
	//ユーザー名
	if(!$username = filter_input(INPUT_POST,'username')){
		$err[] = 'ユーザー名を記入してください。';
	}
	//メールアドレス
	if(!$email = filter_input(INPUT_POST,'email')){
		$err[] = 'メールアドレスを記入してください。';
	}
	//パスワード（正規表現）
	$password = filter_input(INPUT_POST,'password');
	if(!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)){
		$err[] = 'パスワードは英数字8文字以上100文字以内にしてください。';
	}
	//パスワード確認
	$password_conf = filter_input(INPUT_POST,'password_conf');
	if($password_conf !== $password){
		$err[] = '確認用パスワードと異なっています。';
	}
*/

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
<section id="registerphp">
<section class="spacer_50"></section>
<?php if(count($err) > 0):?>
	<?php foreach($err as $e):?>
		<p><?php echo $e?></p>
	<?php endforeach;?>
<?php else:?>
	<p>ユーザー情報の更新が完了しました。</p>
<?php endif;?>

<a href="./index.php?year=<?php echo date("Y")?>" class="selfinput send-btn">トップへ戻る</a>
<section class="spacer_50"></section>
</section>
</body>
</html>