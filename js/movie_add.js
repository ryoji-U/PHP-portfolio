var fileAreaMovie = document.getElementById('drag-drop-area-movie');
var fileSizeMovie = document.getElementById('fileSize_movie');

fileAreaMovie.addEventListener('dragover', function(evt){
  evt.preventDefault();
  fileAreaMovie.classList.add('dragover');
  //console.log('overm');
});

fileAreaMovie.addEventListener('dragleave', function(evt){
    evt.preventDefault();
    fileAreaMovie.classList.remove('dragover');
    //console.log('leave');
});

fileAreaMovie.addEventListener('drop', function(evt){
    evt.preventDefault();
    fileAreaMovie.classList.remove('dragenter');
    var files = evt.dataTransfer.files;
    //ファイルの大きさを確認する
    const file_size = document.querySelector("#fileSize_movie");
    fileSizeMovie.files = files;
    console.log(files[0].type);
    if(!files[0].type.match(/video/)){
      alert('ここには動画を挿入してください。');
    }else{
      moviePreview0('onChenge',files[0]);
    }
});


//---------------------------------------

function moviePreview0(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[1];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewArea_movie");
  var previewMovie = document.getElementById("previewMovie");
  var previewInputM = document.getElementById("previewInputM");

  var classList = document.createElement("section");
  classList.id = "movie";
  preview.appendChild(classList);
  var classList0 = document.getElementById("movie");

  //プレビュー画像を削除
  if(previewMovie != null) {
    classList0.removeChild(previewMovie);
  }
  //inputタグ削除
  if(previewInputM != null) {
    classList0.removeChild(previewInputM);
  }

  reader.onload = function(event) {
    var video = document.createElement("video");
    video.setAttribute("src", reader.result);
    video.setAttribute("id", "previewMovie");
    video.setAttribute("controls","true");
    //video.controls = boolean;
    //video.innerHTML = '<div>おはよう</div>';
    classList0.appendChild(video);

    var movie1 = document.createElement("input");
    movie1.type = "hidden";
    movie1.id = "test";
    movie1.name = "movie";
    movie1.value = file.name;
    movie1.setAttribute("id", "previewInputM");
    classList0.appendChild(movie1);
  };

  reader.readAsDataURL(file);
  //console.log(file);
}
