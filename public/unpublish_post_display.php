
<?php foreach($post as $column):?>
<!--投稿状況を確認-->
<?php if($instagram->h($column['publish_status']) == 2):?>
	<section class="insta-list">
		<div class="insta-content insta-title">
			
			<!--トップ画像と投稿者名を設置-->
			<?php $postUser = $instagram->postUser($column['user_id'])?>
			<!--トップ画像-->
			<div class="top_image">
				<?php if(isset($postUser[0]['top_image'])) echo "<img src=".$postUser[0]['top_image'].">"?>
			</div>
			<!--投稿者名-->
			<div class="post_user">
				<?php if(isset($postUser[0]['username'])):?>
					<?php echo $postUser[0]['username']?>
				<?php else:?>
					NoNAME
				<?php endif;?>
			</div>
			<br>

		</div>

		<!--スライドテスト-->
		<?php $postData = $instagram->getById($column['id']);?>
		<?php 
			$slideCount = 0;
			for($i=0;$i<8;$i++){
				if($postData["slide$i"]){
					$slideCount++;
				}
			}
			if($column['movie']){
				$slideCount++;
			}
		?>

		<?php if($slideCount<=1):?>	
			<div class="insta-images">
				<img src="<?php echo $instagram->h($column['slide0'])?>">
			</div><br/>
		<?php else:?>
			<div class="insta-images slider-content">
			<ul>
				<?php for($i=0;$i<$slideCount;$i++):?>
					<?php if($i == 0):?>
						<li class="slide active"><img src="<?php echo $postData["slide$i"]?>"></li>
					<?php else:?>
						<li class="slide"><img src="<?php echo $postData["slide$i"]?>"></li>
					<?php endif;?>
				<?php endfor;?>
					<?php if($column['movie']):?>
						<li class="slide"><video src="<?php echo $column["movie"]?>" controls></video></li>
					<?php endif;?>
			</ul>
			</div>
			<section class="index-btn-all">
				<?php for($i=0;$i<$slideCount;$i++):?>
					<div class="index-btn" data-option="<?php echo $i?>"><img src="<?php echo $postData["slide$i"]?>"></div>
				<?php endfor;?>
				<?php if($column['movie']):?>
					<div class="index-btn" data-option="<?php echo $i?>"><img src="../images/movie.jpg"></div>
				<?php endif;?>
			</section>
		<?php endif;?>

		<!--スライドテスト-->

		<div class="insta-content">

			<h3 class="post-title"><?php echo $instagram->h($column['title'])?><br/></h3>
			<p><?php echo nl2br($instagram->h($column['content']))?><br/></p>
			#<?php echo $instagram->h($instagram->setCategoryName($column['category']))?><br/>
			<?php echo $instagram->h($column['post_at'])?><br/>

			<section class="content-btton-all">
				
				<!--いいねボタン-->
				<div class="good-result">
				<?php $goodResult = $instagram->ckeckGood($instagram->h($column['id']),$instagram->h($login_user['id']));?>
					<?php if($goodResult == true):?>
					<sectoin class="good-btn">
						<form action="good_btn.php" method="post" class="AjaxForm">
							<input type="hidden" value="<?php echo $instagram->h($login_user['id'])?>" name="user_id">
							<input type="hidden" value="<?php echo $instagram->h($column['id'])?>" name="post_id">
							<input type="submit" value="&#xf004" class="submit good-icon">
						</form>
					</sectoin>
					<?php else:?>
					<sectoin class="good-btn">
						<form action="good_delete.php" method="post" class="AjaxForm">
							<input type="hidden" value="<?php echo $instagram->h($login_user['id'])?>" name="user_id">
							<input type="hidden" value="<?php echo $instagram->h($column['id'])?>" name="post_id">
							<input type="submit" value="&#xf004" class="submit delete-icon">
						</form>
					</sectoin>
					<?php endif;?>
				</div><!--result-->

				<a class="comment-detail" href="./comment_detail.php?id=<?php echo $column['id']?>"><i class="far fa-comments"></i></a><br/>
				<!--編集・削除ボタンは自分の投稿にのみ表示される-->
				
				<?php if($column['post_address']):?>
				<div class="address">
					<a href="https://www.google.com/maps?q=<?php echo $column['post_address'];?>" target="blank">
						<i class="fas fa-map-marker-alt"></i>
					</a>
				</div>
				<?php endif;?>

				<?php if($instagram->h($login_user['id']) == $instagram->h($column['user_id'])):?>
					<a class="updata post-updata" href="./update_form.php?id=<?php echo $column['id']?>"><i class="fas fa-pen"></i></a><br/>
					<a class="delete post-delete" href="javascript:if(confirm('本当に削除しますか？')==true) document.location='./instagram_delete.php?id=<?php echo $column['id']?>'; else alert('キャンセルされました');"><i class="fas fa-trash-alt"></i></a>
				<?php endif;?>

			</section>
		

		</div>
	</section>

<?php endif;?>
<?php endforeach;?>