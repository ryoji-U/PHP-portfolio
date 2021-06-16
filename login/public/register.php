<?php

//require_once('../../header.php');
session_start();
require_once('../classes/userLogic.php');

//エラーメッセージ（エラーを溜める）
$err = [];

$token = filter_input(INPUT_POST,'csrf_token');
//トークンが無い、もしくは一致しない場合、処理を中止する。
//二重送信とURLを直接たたいてページに遷移されることを防ぐ。
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
	exit('不正なリクエスト');
}

unset($_SESSION['csrf_token']);

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
	
$logic = new UserLogic();

//エラーがない場合、ユーザー登録の処理を行う
if(count($err) === 0){
	$hasCreated = $logic->createUser($_POST);
	
	if(!$hasCreated){
		$err[] = '登録に失敗しました。';
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ユーザー登録完了画面</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../..//css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/9f2e7499ce.js"></script>
</head>
<body>
<section id="registerphp">
<section class="spacer_50"></section>
<?php if(count($err) > 0):?>
	<?php foreach($err as $e):?>
		<p><?php echo $e?></p>
	<?php endforeach;?>
<?php else:?>
	<p>登録が完了しました。</p>
<?php endif;?>

<a href="./signup_form.php" class="selfinput send-btn">新規登録画面へ戻る</a>
<section class="spacer_50"></section>
</section>
</body>
</html>