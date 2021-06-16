<?php
require_once ('../../dbc.php');

class UserLogic extends Dbc{
	protected $table_name = 'users';
	
	//ユーザー登録
	//public static function createUser(
	public function createUser($userData){
		$result = false;
		
		$sql = "INSERT INTO 
					$this->table_name(username,email,password)
				VALUES
					(?,?,?)";
					
		//ユーザーデータを配列に入れる
		$arr = [];
		$arr[] = $userData['username'];
		$arr[] = $userData['email'];
		$arr[] = password_hash($userData['password'],PASSWORD_DEFAULT);
		
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$result = $stmt->execute($arr);
			return $result;
		}catch(\Exception $e){
			echo $e->getMessage();
			return $result;
		}
	}
	
	public static function login($email,$password){
		$result = false;
		
		$user = self::getUserByEmail($email);
		
		if(!$user){
			$_SESSION['msg'] = 'メールアドレスが一致しません。';
			return $result;
		}
		
		//パスワードの照会
		if(password_verify($password,$user['password'])){
			session_regenerate_id(true);//古いセッションIDを破棄して、セッションハイジャックを防ぐ
			$_SESSION['login_user'] = $user;
			$result = true;
			return $result;
		}
		$_SESSION['msg']= 'パスワードが一致しません。';
		return $result;
	}
	
	public static function getUserByEmail($email){
		//上から取ってこれなかった
		$table_name = 'users';
		
		$sql = "SELECT * FROM $table_name 
				WHERE email = ?";
		$arr = [];
		$arr[] = $email;
		
		//dbc.phpから取ってこれなかった-----------------------
		function dbConnect(){
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
		//----------------------------------------------
		
		try{
			$stmt = dbConnect()->prepare($sql);
			$stmt->execute($arr);
			$user = $stmt->fetch();
			return $user;
		}catch(\Exception $e){
			return false;
		}
	}
	
	//ログインされているかチェック
	public static function checkLogin(){
		$result = false;
		
		if(isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0){
			return $result = true;
		}
		return $result;
	}
}

?>