<?php

require_once ('../dbc.php');
require_once ('instagram.php');

//extendsだと、その後のクラスの中身を引き継いだものとなる
class Slide extends Instagram{

	protected $table_name = 'slide';
	
	//スライダー制作メソッド
	public function slideCreateMethod($instagrams,$userId){
		//スライド1を制作
		$this->slide0Create($instagrams['slides'],$instagrams['id'],$userId,$instagrams['images']);

		//スライド1のIDを取得
		$slide_id = $this->getSlideId($instagrams['id']);

		//スライド2~8を制作
		for($i=0;$i<8;$i++){
			if(empty($instagrams['slides'][$i])){
				$instagrams['slides'][$i] = null;
			}
		}
		if($instagrams['slides'][0]){
			$instagrams['slides'][0] = "../images/".$instagrams['slides'][0];
			$this->slide1Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][1]){
			$instagrams['slides'][1] = "../images/".$instagrams['slides'][1];
			$this->slide1Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][2]){
			$instagrams['slides'][2] = "../images/".$instagrams['slides'][2];
			$this->slide2Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][3]){
			$instagrams['slides'][3] = "../images/".$instagrams['slides'][3];
			$this->slide3Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][4]){
			$instagrams['slides'][4] = "../images/".$instagrams['slides'][4];
			$this->slide4Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][5]){
			$instagrams['slides'][5] = "../images/".$instagrams['slides'][5];
			$this->slide5Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][6]){
			$instagrams['slides'][6] = "../images/".$instagrams['slides'][6];
			$this->slide6Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][7]){
			$instagrams['slides'][7] = "../images/".$instagrams['slides'][7];
			$this->slide7Create($instagrams['slides'],$slide_id['id']);
		}
	}

	//スライダーが存在するかチェックする
	public function checkSlide($postId){
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT *
				FROM $this->table_name
				WhERE post_id = :id";
		//SQLの準備
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id',(INT)$postId,PDO::PARAM_INT);
		//SQLの実行
		$stmt->execute();
		//結果を取得
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function slideUpdateMethod($instagrams,$userId){
		if(count($instagrams['slides']) > 7){
			echo "	s<section class='return-btn-all'>
					スライダーの画像を7枚以下にしてください。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		//どこのスライダーか判別
		$slide_id = $this->getSlideId($instagrams['id']);

		//スライド1~8をアップデート
		for($i=0;$i<8;$i++){
			if(empty($instagrams['slides'][$i])){
				$instagrams['slides'][$i] = null;
			}
		}
		
		$this->slide0Update($instagrams['slides'],$slide_id['id'],$instagrams['images']);
		
		if($instagrams['slides'][0]){
			$instagrams['slides'][0] = "../images/".$instagrams['slides'][0];
			$this->slide1Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][1]){
			$instagrams['slides'][1] = "../images/".$instagrams['slides'][1];
			$this->slide2Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][2]){
			$instagrams['slides'][2] = "../images/".$instagrams['slides'][2];
			$this->slide3Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][3]){
			$instagrams['slides'][3] = "../images/".$instagrams['slides'][3];
			$this->slide4Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][4]){
			$instagrams['slides'][4] = "../images/".$instagrams['slides'][4];
			$this->slide5Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][5]){
			$instagrams['slides'][5] = "../images/".$instagrams['slides'][5];
			$this->slide6Create($instagrams['slides'],$slide_id['id']);
		}
		if($instagrams['slides'][6]){
			$instagrams['slides'][6] = "../images/".$instagrams['slides'][6];
			$this->slide7Create($instagrams['slides'],$slide_id['id']);
		}
		/*if($instagrams['slides'][7]){
			$instagrams['slides'][7] = "../images/".$instagrams['slides'][7];
			$this->slide7Create($instagrams['slides'],$slide_id['id']);
		}*/

	}

	//投稿削除機能
	public function slideDelete($instagrams){
		if(count($instagrams['slides']) > 7){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					スライダーの画像を7枚以下にしてください。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		$sql = "UPDATE $this->table_name SET
					image_1 = null,image_2 = null,image_3 = null,image_4 = null,image_5 = null,image_6 = null,image_7 = null
				WHERE
					post_id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$instagrams['id'],PDO::PARAM_INT);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	public function slidePermanentlyDelete($instagrams){
		$dbh = $this->dbConnect();

		$sql = "DELETE 
				FROM $this->table_name 
				WHERE post_id = :id";

		//SQLの準備
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id',(INT)$instagrams['id'],PDO::PARAM_INT);

		//SQLの実行
		$stmt->execute();
		//echo 'ブログを削除しました';
	}

	//スライダーの順番を変更
	public function slideNumberEdit($slideNum,$post_id,$instagrams){
		$dbh = $this->dbConnect();

		//スライダーの情報を取得
		$slide_id = $this->getSlideId($instagrams['id']);

		if(empty($slideNum[0])){
		}elseif($slideNum[0]){
			//$slideNum[0] = "../images/".$slideNum[0];
			$this->slide0NumUpdate($slideNum,$slide_id['id']);
		}
		if(empty($slideNum[1])){
		}elseif($slideNum[1]){
			//$slideNum[1] = "../images/".$slideNum[1];
			$this->slide1NumUpdate($slideNum,$slide_id['id']);
		}
		if(empty($slideNum[2])){
		}elseif($slideNum[2]){
			//$slideNum[2] = "../images/".$slideNum[2];
			$this->slide2NumUpdate($slideNum,$slide_id['id']);
		}
		if(empty($slideNum[3])){
		}elseif($slideNum[3]){
			//$slideNum[3] = "../images/".$slideNum[3];
			$this->slide3NumUpdate($slideNum,$slide_id['id']);
		}
		if(empty($slideNum[4])){
		}elseif($slideNum[4]){
			//$slideNum[4] = "../images/".$slideNum[4];
			$this->slide4NumUpdate($slideNum,$slide_id['id']);
		}
		if(empty($slideNum[5])){
		}elseif($slideNum[5]){
			//$slideNum[5] = "../images/".$slideNum[5];
			$this->slide5NumUpdate($slideNum,$slide_id['id']);
		}
		if(empty($slideNum[6])){
		}elseif($slideNum[6]){
			//$slideNum[6] = "../images/".$slideNum[6];
			$this->slide6NumUpdate($slideNum,$slide_id['id']);
		}
		if(empty($slideNum[7])){
		}elseif($slideNum[7]){
			//$slideNum[7] = "../images/".$slideNum[6];
			$this->slide7NumUpdate($slideNum,$slide_id['id']);
		}
	}

	//-----------------------------------------------------------------------
	//スライド1
	public function slide0Create($slides,$postId,$userId,$image){
		if(count($slides) > 7){
			$presentYear = date("Y");
			$presentMonth = date("m");
			echo "	<section class='return-btn-all'>
					スライダーの画像を7枚以下にしてください。<br>
					<div class='spacer_50'></div>
					<div class='return-btn'><a href='../public/index.php?year=$presentYear&month=$presentMonth'>トップへ戻る</a></div></section>";
			exit();
		}

		$sql = "INSERT INTO 
					$this->table_name(post_id, user_id, image_0)
				VALUES
					(:postId, :userId, :slides0)";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':postId',$postId,PDO::PARAM_INT);
			$stmt->bindValue(':userId',$userId,PDO::PARAM_INT);
			$stmt->bindValue(':slides0',$image,PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライドIDを取得
	public function getSlideId($postId){
		$dbh = $this->dbConnect();
		//1.SQLの準備
		$sql = "SELECT *
				FROM $this->table_name
				WhERE post_id = :id";
		//SQLの準備
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id',(INT)$postId,PDO::PARAM_INT);
		//SQLの実行
		$stmt->execute();
		//結果を取得
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function slide0Update($slides,$id,$image){

		$sql = "UPDATE $this->table_name SET
					image_0 = :slides0
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides0',$image,PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド2
	public function slide1Create($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_1 = :slides1
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides1',$slides[0],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド3
	public function slide2Create($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_2 = :slides2
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides2',$slides[1],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド4
	public function slide3Create($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_3 = :slides3
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides3',$slides[2],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド5
	public function slide4Create($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_4 = :slides4
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides4',$slides[3],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド6
	public function slide5Create($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_5 = :slides5
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides5',$slides[4],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド7
	public function slide6Create($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_6 = :slides6
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides6',$slides[5],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド8
	public function slide7Create($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_7 = :slides7
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides7',$slides[6],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}
	//-----------------------------------------------------------------------

	//スライド順番変更
	//スライド1$this->slide0NumUpdate($slideNum,$post_id);
	public function slide0NumUpdate($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_0 = :slides0
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides0',$slides[0],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド2
	public function slide1NumUpdate($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_1 = :slides1
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides1',$slides[1],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド3
	public function slide2NumUpdate($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_2 = :slides2
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides2',$slides[2],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド4
	public function slide3NumUpdate($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_3 = :slides3
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides3',$slides[3],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド5
	public function slide4NumUpdate($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_4 = :slides4
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides4',$slides[4],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド6
	public function slide5NumUpdate($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_5 = :slides5
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides5',$slides[5],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド7
	public function slide6NumUpdate($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_6 = :slides6
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides6',$slides[6],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

	//スライド8
	public function slide7NumUpdate($slides,$id){
		$sql = "UPDATE $this->table_name SET
					image_7 = :slides7
				WHERE
					id = :id";
	
		$dbh = $this->dbConnect();
		
		try{
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':slides7',$slides[7],PDO::PARAM_STR);
			$stmt->execute();
			//echo "投稿しました";
		}catch(PDOException $e){
			exit($e);
		}
	}

}



?>