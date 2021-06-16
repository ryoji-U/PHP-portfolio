

/*  <div id="btn"></div>

var btn = document.getElementById('btn');
var count = 0;
btn.addEventListener('click',function(){
	if(btn.style.background == 'red'){
		btn.style.background = 'white';
		btn.style.transition = '1s';
		btn.style.width = '250px';
		count = 0;
		//btn.innerHTML = 'ボタン2';
		console.log(count);
		return;
	}
	btn.style.background = 'red';
	btn.style.transition = '1s';
	btn.style.width = '50px';
	count = 1;
	console.log(count);
	return;
});*/


//ページ遷移無しでPHPを実行

  jQuery('.AjaxForm').click(function(event){
    //var good_btn_num = <?php echo $instagram->h($column['id'])?>;
    //HTMLでの送信をキャンセル
    event.preventDefault();
    var $form = $(this);
    var $button = $form.find('.submit');
    var $result = $(this).parent().parent('.good-result');
    var $good_btn = $(this).parent('.good-btn');
    $.ajax({
      url : $form.attr('action'),
      type : $form.attr('method'),
      data : $form.serialize(),
      timeout : 10000,
      //送信前
      beforeSend : function(xhr,settings){
      //ボタンを無効化し、二重送信を防止
      $button.attr('desabled',true);
      $result.html('');
      $good_btn.html('');
      //console.log(good_btn_num);
      },
      //応答後
      complete: function(xhr,textStatus){
      //ボタンを有効化し、再送信を許可
      $button.attr('disaled',false);
      },
      //通信成功時の処理
      success:function(result,textStatus,xhr){
      //入力値を初期化
      $form[0].reset();
      $result.append(result);
      },
      //通信失敗時の処理
      error:function(xhr,textStatus,error){
      alert('エラー。暫く経ってからお試しください。');
      }
    });
  });
