<?php

require_once('../dbc.php');

//extends(継承)することで、protectedの関数を使えるようになる
class Comment extends Dbc{
	protected $table_name = 'comment';
	
	//コメントを生成する関数***********************************
	public function commentCreate($comments){
		$sql = "INSERT INTO
					$this->table_name(content,user_id,post_id)
				VALUES
					(:content,:user_id,:post_id)";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue('content',$comments['content']);
			$stmt->bindValue('user_id',$comments['user_id']);
			$stmt->bindValue('post_id',$comments['post_id']);
			$stmt->execute();
		}catch(PDOException $e){
			exit($e);
		}
	}
	
	//コメントに対するリプライを生成する関数***********************************
	public function commentReplyCreate($comments){
		$table_name = 'comment_reply';
		$sql = "INSERT INTO
					$table_name(content,user_id,post_id,comment_id)
				VALUES
					(:content,:user_id,:post_id,:comment_id)";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue('content',$comments['content']);
			$stmt->bindValue('user_id',$comments['user_id']);
			$stmt->bindValue('post_id',$comments['post_id']);
			$stmt->bindValue('comment_id',$comments['comment_id']);
			$stmt->execute();
		}catch(PDOException $e){
			exit($e);
		}
	}
	
	//コメントに対するリプライを表示する関数***********************************
	public function getReply($comment_id){		
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT * 
				FROM comment_reply
				WHERE comment_id = $comment_id";
		//2.SQLの実行
		$stmt = $dbh->query($sql);
		//3.SQLの結果を受け取る
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $result;
	}		
	
	//バリデーション関数***********************************
	public function commentValidate($comments){
		if($comments['content'] == null || $comments['content'] == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					コメントを入力してください。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		if($comments['post_id'] == null || $comments['post_id'] == ''){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					もう一度入力し直してください。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}
	}
	
}

?>