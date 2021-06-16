var fileArea = document.getElementById('drag-drop-area');
var fileSize = document.getElementById('fileSize');

fileArea.addEventListener('dragover', function(evt){
  evt.preventDefault();
  fileArea.classList.add('dragover');
  //console.log('over');
});

fileArea.addEventListener('dragleave', function(evt){
    evt.preventDefault();
    fileArea.classList.remove('dragover');
    //console.log('leave');
});

fileArea.addEventListener('drop', function(evt){
    evt.preventDefault();
    fileArea.classList.remove('dragenter');
    var files = evt.dataTransfer.files;
    //ファイルの大きさを確認する
    const file_size = document.querySelector("#fileSize");
    fileSize.files = files;
    if(files.length > 1){
      alert('画像の枚数を1枚にして下さい。');
    }else{
      if(!files[0].type.match(/image/)){
        alert('ここには画像のみを挿入してください。');
      }else{
        photoPreview0('onChenge',files[0]);
      }
    }
});

//---------------------------------------

function photoPreview0(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[1];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewArea");
  var previewImage = document.getElementById("previewImage");
  var previewInput = document.getElementById("previewInput");

  var classList = document.createElement("section");
  classList.id = "elements0";
  preview.appendChild(classList);
  var classList0 = document.getElementById("elements0");

  //プレビュー画像を削除
  if(previewImage != null) {
    classList0.removeChild(previewImage);
  }
  //inputタグ削除
  if(previewInput != null) {
    classList0.removeChild(previewInput);
  }

  reader.onload = function(event) {
    var img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "previewImage");
    //img.innerHTML = '<div>おはよう</div>';
    classList0.appendChild(img);

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "top_image2";
    slide1.value = "../images/"+file.name;
    slide1.setAttribute("id", "previewInput");
    classList0.appendChild(slide1);
  };

  reader.readAsDataURL(file);
  //console.log(file);
}