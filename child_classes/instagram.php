<?php

require_once('../dbc.php');

//extendsだと、その後のクラスの中身を引き継いだものとなる
class Instagram extends Dbc{
	
	protected $table_name = 'post_data';
	
	//3.カテゴリー名を文字にする
	public function setCategoryName($category){
		if($category === '1'){
			return 'グルメ';
		}elseif($category === '2'){
			return '観光';
		}elseif($category === '3'){
			return 'アクティブ';
		}else{
			return 'その他';
		}
	}
	
	//記事を生成する
	public function instagramCreate($instagrams){
		$sql = "INSERT INTO
					$this->table_name(title,slide0,slide1,slide2,slide3,slide4,slide5,slide6,slide7,movie,content,category,publish_status,user_id,post_address)
				VALUES
					(:title,:slide0,:slide1,:slide2,:slide3,:slide4,:slide5,:slide6,:slide7,:movie,:content,:category,:publish_status,:userid,:post_address)";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':title',$instagrams['title'],PDO::PARAM_STR);
			$stmt->bindValue(':slide0',$instagrams['slide'][0],PDO::PARAM_STR);
			$stmt->bindValue(':slide1',$instagrams['slide'][1],PDO::PARAM_STR);
			$stmt->bindValue(':slide2',$instagrams['slide'][2],PDO::PARAM_STR);
			$stmt->bindValue(':slide3',$instagrams['slide'][3],PDO::PARAM_STR);
			$stmt->bindValue(':slide4',$instagrams['slide'][4],PDO::PARAM_STR);
			$stmt->bindValue(':slide5',$instagrams['slide'][5],PDO::PARAM_STR);
			$stmt->bindValue(':slide6',$instagrams['slide'][6],PDO::PARAM_STR);
			$stmt->bindValue(':slide7',$instagrams['slide'][7],PDO::PARAM_STR);
			$stmt->bindValue(':movie',$instagrams['movie'],PDO::PARAM_STR);
			$stmt->bindValue(':content',$instagrams['content'],PDO::PARAM_STR);
			$stmt->bindValue(':category',$instagrams['category'],PDO::PARAM_INT);
			$stmt->bindValue(':publish_status',$instagrams['publish_status'],PDO::PARAM_INT);
			$stmt->bindValue(':userid',$instagrams['userid'],PDO::PARAM_INT);
			$stmt->bindValue(':post_address',$instagrams['post_address'],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//記事をアップデート
	public function instagramUpdate($instagrams){
		$sql = "UPDATE $this->table_name SET
					title = :title,slide0 = :slide0,slide1 = :slide1,slide2 = :slide2,slide3 = :slide3,slide4 = :slide4,slide5 = :slide5,slide6 = :slide6,slide7 = :slide7,movie = :movie,content = :content,category = :category,publish_status = :publish_status,post_address = :post_address
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':title',$instagrams['title'],PDO::PARAM_STR);
			$stmt->bindValue(':slide0',$instagrams['slide'][0],PDO::PARAM_STR);
			$stmt->bindValue(':slide1',$instagrams['slide'][1],PDO::PARAM_STR);
			$stmt->bindValue(':slide2',$instagrams['slide'][2],PDO::PARAM_STR);
			$stmt->bindValue(':slide3',$instagrams['slide'][3],PDO::PARAM_STR);
			$stmt->bindValue(':slide4',$instagrams['slide'][4],PDO::PARAM_STR);
			$stmt->bindValue(':slide5',$instagrams['slide'][5],PDO::PARAM_STR);
			$stmt->bindValue(':slide6',$instagrams['slide'][6],PDO::PARAM_STR);
			$stmt->bindValue(':slide7',$instagrams['slide'][7],PDO::PARAM_STR);
			$stmt->bindValue(':movie',$instagrams['movie'],PDO::PARAM_STR);
			$stmt->bindValue(':content',$instagrams['content'],PDO::PARAM_STR);
			$stmt->bindValue(':category',$instagrams['category'],PDO::PARAM_INT);
			$stmt->bindValue(':publish_status',$instagrams['publish_status'],PDO::PARAM_INT);
			$stmt->bindValue(':id',$instagrams['id'],PDO::PARAM_INT);
			$stmt->bindValue(':post_address',$instagrams['post_address'],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿を更新しました";
		}catch(PDOException $e){
			exit($e);
		}
	}
	
	//投稿のバリデーション（入力されているか確認する）
	public function instagramValidate($instagrams){
		$error = true;

		if($instagrams['title'] == null || $instagrams['title'] == ''){
			echo "	<section class='return-btn-all'>
					タイトルを入力してください。<br></section>";
			$error = false;
		}
		
		if(mb_strlen($instagrams['title']) > 191){
			echo "	<section class='return-btn-all'>
					タイトルを191文字以下にして下さい。<br></section>";
			$error = false;
		}
		
		if(empty($instagrams['slide'][0])){
			echo "	<section class='return-btn-all'>
					1枚以上画像を挿入して下さい。<br></section>";
			$error = false;
		}
		
		if($instagrams['content'] == null || $instagrams['content'] == ''){
			echo "	<section class='return-btn-all'>
					本文を入力して下さい。<br></section>";
			$error = false;
		}
		
		if($instagrams['category'] == null || $instagrams['category'] == ''){
			echo "	<section class='return-btn-all'>
					カテゴリーを入力して下さい。<br></section>";
			$error = false;
		}
		
		if($instagrams['publish_status'] == null || $instagrams['publish_status'] == ''){
			echo "	<section class='return-btn-all'>
					公開状況を入力してください。<br></section>";
			$error = false;
		}
		
		//パスワード正規化
		if(empty($userdata['password'])){}else{
			$userdata['password'] = filter_input(INPUT_POST,'password');
			if(!preg_match("/\A[a-z\d]{8,100}+\z/i",$userdata['password'])){
				$err[] = 'パスワードは英数字8文字以上100文字以内にしてください。';
				$presentYear = date("Y");
				$presentMonth = date("m");
				echo "	<section class='return-btn-all'>
						パスワードは英数字8文字以上100文字以内にしてください。<br>
						<div class='spacer_50'></div>
						<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
				exit();
			}
			//パスワード確認
			$userdata['password_conf'] = filter_input(INPUT_POST,'password_conf');
			if($userdata['password_conf'] !== $userdata['password']){
				$err[] = '確認用パスワードと異なっています。';
				$presentYear = date("Y");
				$presentMonth = date("m");
				echo "	<section class='return-btn-all'>
						確認用パスワードと異なっています。<br>
						<div class='spacer_50'></div>
						<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
				exit();
			}
		}

		if($error == false){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					<div class='spacer_50'></div>
					<div class='return-btn'><a onclick='history.back(-1)'>ページを一つ戻る</a></div>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}
	}

	//ユーザー情報更新メソッド
	public function userDataUpdateNoPass($userdata){
		$sql = "UPDATE users SET
					username = :username,top_image = :top_image,email = :email
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':username',$userdata['username'],PDO::PARAM_STR);
			$stmt->bindValue(':top_image',$userdata['top_image'],PDO::PARAM_STR);
			$stmt->bindValue(':email',$userdata['email'],PDO::PARAM_STR);
			$stmt->bindValue(':id',$userdata['id'],PDO::PARAM_INT);
			$stmt->execute();
			//echo "ユーザー情報を更新しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//ユーザー情報更新メソッド
	public function userDataUpdate($userdata){
		$sql = "UPDATE users SET
					username = :username,top_image = :top_image,email = :email,password = :password
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':username',$userdata['username'],PDO::PARAM_STR);
			$stmt->bindValue(':top_image',$userdata['top_image'],PDO::PARAM_STR);
			$stmt->bindValue(':email',$userdata['email'],PDO::PARAM_STR);
			$stmt->bindValue(':password',password_hash($userdata['password'],PASSWORD_DEFAULT));
			$stmt->bindValue(':id',$userdata['id'],PDO::PARAM_INT);
			$stmt->execute();
			//echo "ユーザー情報を更新しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	public function fileSizeUser($userdata,$files){
		$path = '../images/';
		$before_file = $files["top_file2"]["tmp_name"];
		List($original_w,$original_h,$type) = @getimagesize($before_file);

		$rate = ($original_w / 200);
		if($rate > 1){
			$w = floor((1 / $rate) * $original_w);
			$h = floor((1 / $rate) * $original_h);
			echo "小さくしました";
			echo '高さ:'.$h;
		}else{
			$w = $original_w;
			$h = $original_h;
			//echo "そのままでも大丈夫です";
		}

		switch($type){
			case IMAGETYPE_JPEG:
				$original_image = @imagecreatefromjpeg($before_file);
			break;
			case IMAGETYPE_PNG:
				$original_image = @imagecreatefrompng($before_file);
			break;
			default:
			throw new RuntimeException('対応していないファイル形式です。',$type);
		}

		$canvas = @imagecreatetruecolor($w,$h);
		@imagecopyresampled($canvas,$original_image,0,0,0,0,$w,$h,$original_w,$original_h);

		$dateformat = date("Ymdhis");
		$resize_path = "$path$dateformat".".jpg";

		$userdata['top_image2'] = $resize_path;
			
		@imagejpeg($canvas,$resize_path);
		/*
		switch($type){
			case IMAGETYPE_JPEG:
				@imagejpeg($canvas,$resize_path);
			break;
			case IMAGETYPE_PNG:
				@imagepng($canvas,$resize_path,9);
			break;
		}*/

		@imagedestroy($original_image);
		@imagedestroy($canvas);
		return $userdata;
	}
	
	//ユーザー情報のバリデーション
	public function userDataValidate($userdata){
		$error = true;

		if($userdata['username'] == null || $userdata['username'] == ''){
			echo "	<section class='return-btn-all'>
					ユーザー名を入力して下さい。<br></section>";
			$error = false;
		}
		
		if(mb_strlen($userdata['username']) > 64){
			echo "	<section class='return-btn-all'>
					ユーザー名を64文字以下にして下さい。<br></section>";
			$error = false;
		}
		
		if($userdata['top_image'] == null || $userdata['top_image'] == ''){
			echo "	<section class='return-btn-all'>
					画像URLを入力して下さい。<br></section>";
			$error = false;
		}
		
		if($userdata['email'] == null || $userdata['email'] == ''){
			echo "	<section class='return-btn-all'>
					メールアドレスを入力して下さい。<br></section>";
			$error = false;
		}

		if(empty($userdata['password'])){}else{
			//パスワード（正規表現）
			$password = $userdata['password'];
			if(!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)){
				echo "	<section class='return-btn-all'>
						パスワードは英数字8文字以上100文字以内にしてください。<br></section>";
				$error = false;
			}
			
			//パスワード確認
			if($userdata['password'] !== $userdata['password_conf']){
				echo "	<section class='return-btn-all'>
						確認用パスワードと異なっています。<br></section>";
				$error = false;
			}
		}

		if($error == false){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					<div class='spacer_50'></div>
					<div class='return-btn'><a onclick='history.back(-1)'>ページを一つ戻る</a></div><br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}
	}


	//ユーザー情報更新後、セッションをリセットする。
	public function userdataUpload($userId){
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT * 
				FROM users
				WHERE id = $userId";
		//2.SQLの実行
		$stmt = $dbh->query($sql);
		//3.SQLの結果を受け取る
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $result;
		$dbh = null;
	}

	//いいね追加ボタン
	public function goodbtn($postId,$userId){
		$dbh = $this->dbConnect();

		$sql = "INSERT INTO good(post_id, user_id)
				VALUE(:postId, :userId)";
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':postId',$postId,PDO::PARAM_INT);
			$stmt->bindValue(':userId',$userId,PDO::PARAM_INT);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	public function fileSize($instagrams,$files){
		$path = '../images/';
		for($i=0;$i<8;$i++){
			if(empty($_FILES['file']['name'][$i])){
				//echo "ファイルがありません。";
				$i=8;
			}else{
				for($ii=0;$ii<8;$ii++){
					if(empty($_FILES['file']['name'][$ii]) || empty($instagrams['slide'][$i])){
						$ii = 8;
					}elseif($instagrams['slide'][$i] == $_FILES['file']['name'][$ii]){
						$before_file = $files["file"]["tmp_name"][$ii];
						
						//$imagick = new \Imagick(realpath($before_file));
						//$before_file = $imagick->setImageResolution(72,72);
						//$before_file = Imagick::setImageResolution(72,72);

						List($original_w,$original_h,$type) = @getimagesize($before_file);
		
						$rate_w = ($original_w / 460);
						if($rate_w > 1){
							$w = floor((1 / $rate_w) * $original_w);
							$h = floor((1 / $rate_w) * $original_h);
							echo "小さくしました";
							echo '高さ:'.$h;
						}else{
							echo "そのままでも大丈夫です";
						}

						$rate_h = ($original_h / 350);
						if($rate_h > 1){
							$w = floor((1 / $rate_h) * $original_w);
							$h = floor((1 / $rate_h) * $original_h);
							echo "小さくしました";
							echo '高さ:'.$h;
						}else{
							$w = $original_w;
							$h = $original_h;
							//echo "そのままでも大丈夫です";
						}
		
						switch($type){
							case IMAGETYPE_JPEG:
								$original_image = @imagecreatefromjpeg($before_file);
							break;
							case IMAGETYPE_PNG:
								$original_image = @imagecreatefrompng($before_file);
							break;
							default:
							throw new RuntimeException('対応していないファイル形式です。',$type);
						}

						$canvas = @imagecreatetruecolor($w,$h);
						@imagecopyresampled($canvas,$original_image,0,0,0,0,$w,$h,$original_w,$original_h);
						
						//dpiの変更
						//@imageresolution($canvas,9);
		
						$dateformat = date("Ymdhis");
						$resize_path = "$path$dateformat$i".".jpg";

						$instagrams['slide'][$i] = $resize_path;
						$ii = 8;
							
						@imagejpeg($canvas,$resize_path);

						/*下記コードだとpng画像はpng画像として保存されてしまう。
						switch($type){
							case IMAGETYPE_JPEG:
								@imagejpeg($canvas,$resize_path);
							break;
							case IMAGETYPE_PNG:
								@imagepng($canvas,$resize_path,9);
							break;
						}*/
					}
				}

				@imagedestroy($original_image);
				@imagedestroy($canvas);
			}
		}
		return $instagrams;
	}

	//画像の大きさを判定とファイル名を日付の数字羅列に変更
	public function movieSize($instagrams,$files){
		$path = '../images/';
		if($_FILES['video']['size'] < 500000000){
			//サイズが大丈夫な場合、フォルダにアップロードする
			//順番を入れ替えた状態でファイル名を日付の数字羅列に
			list($file_name,$file_type) = explode(".",$_FILES['video']['name']);
			$dateformat = date("Ymdhis");
			$uploadfile = "$path$dateformat.$file_type";//$uploadfileには、日付でファイル名が格納されている
			move_uploaded_file($_FILES['video']['tmp_name'],$uploadfile);
			$instagrams['movie'] = $uploadfile;
		}else{
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					ファイルのサイズが大きいため、アップロードできません。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}
		return $instagrams;
	}

}

?>