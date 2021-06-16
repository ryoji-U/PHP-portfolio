<?php
require_once('env.php');

class Dbc{
	
	//namespace Insta\Dbc;
	
	protected $table_name;


	//1.データベースに接続する
	protected function dbConnect(){
		$host = DB_HOST;
		$dbname = DB_NAME;
		$user = DB_USER;
		$pass = DB_PASS;
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
		
		//エラーを表示させる（接続テスト）
		try{
			$dbh = new PDO($dsn,$user,$pass,[
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			]);
			//echo '接続成功';
		}catch(PDOException $e){
			echo '接続失敗'.$e->getMessage();
			exit();
		}
		return $dbh;
	}

	//2.データを取得する
	public function getAll(){
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "
			select * 
			from $this->table_name";
		//2.SQLの実行
		$stmt = $dbh->query($sql);
		//3.SQLの結果を受け取る
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $result;
		$dbh = null;
	}

	//post_dataを西暦ごとに取得
	public function getByYearMonth($year,$month){
		if($year == null || $year == '' || $month == null || $month == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					西暦、月が不正です。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		$dbh = $this->dbConnect();

		$sql = "SELECT * 
				FROM $this->table_name 
				WHERE DATE_FORMAT(post_at,'%Y%m')='$year$month'";

		//SQLの準備
		$stmt = $dbh->query($sql);
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);

		/*
		if(!$result){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "<section class='return-btn-all'>
					投稿がありません。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			//exit();
		}
		*/
		
		return $result;
		$dbh = null;
	}

	//引数：$id
	//返り値：$result
	public function getById($id){
		if($id == null || $id == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					IDが不正です。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		$dbh = $this->dbConnect();

		$sql = "SELECT * 
				FROM $this->table_name 
				WHERE id = :id";

		//SQLの準備
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id',(INT)$id,PDO::PARAM_INT);

		//SQLの実行
		$stmt->execute();
		//結果を取得
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!$result){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					投稿がありません。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}
		
		return $result;
	}
	
	//投稿削除機能
	public function delete($id){
		if($id == null || $id == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					IDが不正です。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		$dbh = $this->dbConnect();

		//SQLの準備
		$stmt = $dbh->prepare("DELETE FROM $this->table_name WHERE id = :id");
		$stmt->bindValue(':id',(INT)$id,PDO::PARAM_INT);

		//SQLの実行
		$stmt->execute();
		//echo 'ブログを削除しました';
	}
	
	//コメント削除機能(1つの記事に対するコメントを全て削除)
	public function deletePostComment($id){
		if($id == null || $id == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					IDが不正です。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		$dbh = $this->dbConnect();

		//SQLの準備
		$stmt = $dbh->prepare("DELETE FROM comment WHERE post_id = :id");
		$stmt->bindValue(':id',(INT)$id,PDO::PARAM_INT);

		//SQLの実行
		$stmt->execute();
		//echo 'ブログを削除しました';
	}

	//コメント削除機能
	public function deleteComment($id){
		if($id == null || $id == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					IDが不正です。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		$dbh = $this->dbConnect();

		//SQLの準備
		$stmt = $dbh->prepare("DELETE FROM comment WHERE id = :id");
		$stmt->bindValue(':id',(INT)$id,PDO::PARAM_INT);

		//SQLの実行
		$stmt->execute();
		//echo 'ブログを削除しました';
	}

	//コメント削除した場合、同時にリプライを削除する機能
	public function deleteCommentDeleteReply($id){
		if($id == null || $id == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					IDが不正です。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		$dbh = $this->dbConnect();

		//SQLの準備
		$stmt = $dbh->prepare("DELETE FROM comment_reply WHERE comment_id = :id");
		$stmt->bindValue(':id',(INT)$id,PDO::PARAM_INT);

		//SQLの実行
		$stmt->execute();
		//echo 'ブログを削除しました';
	}

	//コメントのリプライ削除機能
	public function deleteReplyComment($id){
		if($id == null || $id == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					IDが不正です。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		$dbh = $this->dbConnect();

		//SQLの準備
		$stmt = $dbh->prepare("DELETE FROM comment_reply WHERE id = :id");
		$stmt->bindValue(':id',(INT)$id,PDO::PARAM_INT);

		//SQLの実行
		$stmt->execute();
		//echo 'ブログを削除しました';
	}

	//いいね削除機能
	public function deleteGood($id){
		if($id == null || $id == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					IDが不正です。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		$dbh = $this->dbConnect();

		//SQLの準備
		$stmt = $dbh->prepare("DELETE FROM good WHERE post_id = :id");
		$stmt->bindValue(':id',(INT)$id,PDO::PARAM_INT);

		//SQLの実行
		$stmt->execute();
		//echo 'ブログを削除しました';
	}
	
	//投稿検索機能
	public function getByCategory($category){
		if($category == null || $category == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					カテゴリーを選択して下さい。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}
		
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT * 
				FROM $this->table_name
				WHERE category = $category";
		//2.SQLの実行
		$stmt = $dbh->query($sql);
		//3.SQLの結果を受け取る
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $result;
		$dbh = null;
	}
	
	//コメント検索機能
	public function getComments($id){
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT * 
				FROM $this->table_name
				WHERE post_id = $id";
		//2.SQLの実行
		$stmt = $dbh->query($sql);
		//3.SQLの結果を受け取る
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $result;
		$dbh = null;
	}
	
	//リプライ用のコメント1つのみを取得
	public function getCommentReply($comment_id){
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT * 
				FROM $this->table_name
				WHERE id = $comment_id";
		//2.SQLの実行
		$stmt = $dbh->query($sql);
		//3.SQLの結果を受け取る
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $result;
		$dbh = null;
	}
	
	//タイトル検索機能
	public function titleSearch($searchWord){
		//検索ワードが入っていない場合
		if($searchWord == null || $searchWord == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					検索ワードが入力されていません。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a onclick='history.back(-1)'>ページを一つ戻る</a></div>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT * 
				FROM $this->table_name
				WHERE title LIKE '%$searchWord%'";
		//2.SQLの実行
		$stmt = $dbh->query($sql);
		//3.SQLの結果を受け取る
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $result;
		$dbh = null;
	}

	//2.ユーザーデータを取得する
	public function getUserAll(){
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT * 
				FROM users";
		//2.SQLの実行
		$stmt = $dbh->query($sql);
		//3.SQLの結果を受け取る
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $result;
		$dbh = null;
	}

	//2.IDからユーザーデータを取得する
	public function getUserId($userId){
		if($userId == null || $userId == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					ユーザーを選択して下さい。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}
		
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

	//ユーザーIDから投稿を取得する
	public function getUserById($id){
		if($id == null || $id == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					IDが不正です。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		$dbh = $this->dbConnect();

		$sql = "SELECT * 
				FROM $this->table_name 
				WHERE user_id = :id";

		//SQLの準備
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id',(INT)$id,PDO::PARAM_INT);

		//SQLの実行
		$stmt->execute();
		//結果を取得
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $result;
	}

	//ユーザーIDから投稿を取得する
	public function getByIdUnpublish($id){
		if($id == null || $id == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					IDが不正です。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		$dbh = $this->dbConnect();

		$sql = "SELECT * 
				FROM $this->table_name 
				WHERE user_id = :id";

		//SQLの準備
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id',(INT)$id,PDO::PARAM_INT);

		//SQLの実行
		$stmt->execute();
		//結果を取得
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $result;
	}

	public function dataSearch($date){
		//検索ワードが入っていない場合
		if($date == null || $date == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					検索ワードが入力されていません。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a onclick='history.back(-1)'>ページを一つ戻る</a></div>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}
		$dbh = $this->dbConnect();

		$sql = "SELECT * 
				FROM $this->table_name 
				WHERE DATE_FORMAT(post_at,'%Y%m')='$date' ";

		$stmt = $dbh->query($sql);
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $result;
		$dbh = null;
	}

	//セキュリティ
	public function h($S){
		return htmlspecialchars($S,ENT_QUOTES,"UTF-8");
	}

	//セキュリティ
	function setToken(){
		$csrf_token = bin2hex(random_bytes(32));
		$_SESSION['csrf_token'] = $csrf_token;
		
		return $csrf_token;
	}

	//ログインチェック
	public static function checkLogin(){
		$result = false;
		
		if(isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] >= 0){
			return $result = true;
		}
		return $result;
	}

	//トップ画像を付与
	public function postUser($user_id){
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT * 
				FROM users
				WHERE id = $user_id";
		//2.SQLの実行
		$stmt = $dbh->query($sql);
		//3.SQLの結果を受け取る
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $result;
		$dbh = null;
	}

	//リプライしたユーザーのIDからユーザー名を取得
	public function replyUser($user_id){
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT * 
				FROM users
				WHERE id = $user_id";
		//2.SQLの実行
		$stmt = $dbh->query($sql);
		//3.SQLの結果を受け取る
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $result;
		$dbh = null;
	}

	//コメントからユーザーを取得
	public function commentUser($user_id){
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT * 
				FROM users
				WHERE id = $user_id";
		//2.SQLの実行
		$stmt = $dbh->query($sql);
		//3.SQLの結果を受け取る
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $result;
		$dbh = null;
	}

	//中身が入っているかチェックする
	public function getCheck($id){
		if($id == null || $id == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					不正なアクセスです。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}
	}

	//いいね削除ボタン
	public function goodDelete($postId,$userId){
		$dbh = $this->dbConnect();

		//SQLの準備
		$sql = "DELETE FROM good 
				WHERE post_id = :postId
				AND user_id = :userId";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':postId',(INT)$postId,PDO::PARAM_INT);
		$stmt->bindValue(':userId',(INT)$userId,PDO::PARAM_INT);
		//SQLの実行
		$stmt->execute();
		//echo 'ブログを削除しました';
	}

	//いいねがついているかチェックする
	public function ckeckGood($postId,$userId){
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT * 
				FROM good
				WHERE post_id = :postId
				AND user_id = :userId";
		//2.SQLの実行
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':postId',(INT)$postId,PDO::PARAM_INT);
		$stmt->bindValue(':userId',(INT)$userId,PDO::PARAM_INT);
		$stmt->execute();
		//3.SQLの結果を受け取る
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!$result){
			$result = true;
		}else{
			$result = false;
		}
		
		return $result;
		$dbh = null;
	}

	//いいね検索機能
	public function getByGood($userId){
		if($userId == null || $userId == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					IDがありません。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}
		
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT post_id 
				FROM good
				WHERE user_id = $userId";
		//2.SQLの実行
		$stmt = $dbh->query($sql);
		//3.SQLの結果を受け取る
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $result;
		$dbh = null;
	}

	public function file_downdload($zipName){
		$dist = $zipName.'.zip'; // 生成する圧縮ファイル名
		$path = '../'.$zipName; // 圧縮するフォルダのパス

		//DLするファイルのフォルダ構成を維持するか否か　0:しない／1:する
		//維持する場合、ダウンロードしたファイルは $path の構成になります
		$filePath = 0;
		//DLファイルが１つの場合、フォルダに入れるか否か　0:いれない／1:いれる
		$folderIn = 1;

		$zip = new ZipArchive();
		$zip->open($dist, ZipArchive::CREATE | ZipArchive::OVERWRITE);

		if (is_dir($path)) {
			$files = array_diff(scandir($path), ['.', '..']);
			$filesNum = count($files);
			foreach ($files as $file){
				if($filePath >= 1){ //フォルダ構成を維持する
					$zip->addFile($path.'/'.$file);
				}else{ //維持しない
					if(($folderIn >= 1) && ($filesNum <= 1)){ //ファイルが１つの時、フォルダに収める場合の処理
						$localFile = $zipName.'/';
					}else{
						$localFile = '';
					}
					$zip->addFile($path.'/'.$file, $localFile.$file);
				}
			}
		}
		$zip->close();

		// ストリームに出力
		header('Content-Type: application/zip; name="' . $dist . '"');
		header('Content-Disposition: attachment; filename="' . $dist . '"');
		header('Content-Length: '.filesize($dist));
		//echo file_get_contents($dist);
		readfile($dist);

		// 一時ファイルを削除しておく
		unlink($dist);

		exit;

	}
	

}
?>

