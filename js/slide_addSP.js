var fileAreaSP = document.getElementById('drag-drop-areaSP');
var fileSizeSP = document.getElementById('fileSizeSP');
/*
$('#fileSizeSP').on('change',function(e){
  var reader = new FileReader();
  e.preventDefault();
  var files = e.dataTransfer.files;
  reader.onload = function(e){
    console.log("okk");
    photoPreview0('onChenge',files[0]);
    $("#previewAreaSP").attr("src",e.target.result);
  }
  reader.readAsDataURL(e.target.files[0]);
});
*/

window.onload = function(){
  $('#fileSizeSP').change(function(){
    //$('img').remove();
    //fileの中に挿入された画像のデータを格納
    var file = [];
    for(var $i=0;$i<4;$i++){
      if($(this).prop('files')[$i]){
        file[$i] = $(this).prop('files')[$i];
        console.log(file[$i]);
      }
    }
    //fileの中のデータが画像であるか確認
    for(var $i=0;$i<4;$i++){
      if(file[$i]){
        if(!file[$i].type.match(/image/)){
          return;
        }
      }
    }
    
    console.log('ok');
    var fileReader = new FileReader();
    photoPreviewSP0('onChenge',file[0]);
    if(file[1]){
      photoPreviewSP1('onChenge',file[1]);
    }
    if(file[2]){
      photoPreviewSP2('onChenge',file[2]);
    }
    if(file[3]){
      photoPreviewSP3('onChenge',file[3]);
    }
    /*
    //fileSize.files = files;
    fileReader.addEventListener("load",function(){
      console.log('ok');
      photoPreviewSP0('onChenge',file[0]);
    });
    fileReader.onloadend = function(event){
      console.log('ok');
      
      photoPreviewSP0('onChenge',file[0]);
    }*/
    //fileReader.readAsDataURL(file);
  });
};

jQuery(function() {
  //ドラッグ&ドロップで順番を変えられるようにします。
  jQuery('#previewArea').sortable();
  //テキストの選択をできないようにする。（ドラッグ&ドロップをスムーズに）
  jQuery('#previewArea').disableSelection();
});

jQuery(function() {
  //ドラッグ&ドロップで順番を変えられるようにします。
  jQuery('#updateArea').sortable();
  //テキストの選択をできないようにする。（ドラッグ&ドロップをスムーズに）
  jQuery('#updateArea').disableSelection();
});



//関数
function photoPreviewSP0(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[0];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewAreaSP");
  var previewImage = document.getElementById("previewImageSP");
  var previewInput = document.getElementById("previewInputSP");

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
    img.setAttribute("id", "previewImageSP");
    //img.innerHTML = '<div>おはよう</div>';
    classList0.appendChild(img);
    
    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.name = "slide[]";
    slide1.setAttribute("id", "previewInputSP");
    classList0.appendChild(slide1);

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "slideSP[]";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInputSP");
    classList0.appendChild(slide1);
  };

  console.log('来てます');
  reader.readAsDataURL(file);
  //console.log(file);
}

function photoPreviewSP1(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[1];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewAreaSP");
  var previewImage = document.getElementById("previewImageSP");
  var previewInput = document.getElementById("previewInputSP");

  var classList = document.createElement("section");
  classList.id = "elements1";
  preview.appendChild(classList);
  var classList0 = document.getElementById("elements1");

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
    img.setAttribute("id", "previewImageSP");
    //img.innerHTML = '<div>おはよう</div>';
    classList0.appendChild(img);
    
    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.name = "slide[]";
    slide1.setAttribute("id", "previewInputSP");
    classList0.appendChild(slide1);

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "slideSP[]";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInputSP");
    classList0.appendChild(slide1);
  };

  console.log('来てます');
  reader.readAsDataURL(file);
  //console.log(file);
}

function photoPreviewSP2(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[2];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewAreaSP");
  var previewImage = document.getElementById("previewImageSP");
  var previewInput = document.getElementById("previewInputSP");

  var classList = document.createElement("section");
  classList.id = "elements2";
  preview.appendChild(classList);
  var classList0 = document.getElementById("elements2");

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
    img.setAttribute("id", "previewImageSP");
    //img.innerHTML = '<div>おはよう</div>';
    classList0.appendChild(img);
    
    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.name = "slide[]";
    slide1.setAttribute("id", "previewInputSP");
    classList0.appendChild(slide1);

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "slideSP[]";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInputSP");
    classList0.appendChild(slide1);
  };

  console.log('来てます');
  reader.readAsDataURL(file);
  //console.log(file);
}

function photoPreviewSP3(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[3];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewAreaSP");
  var previewImage = document.getElementById("previewImageSP");
  var previewInput = document.getElementById("previewInputSP");

  var classList = document.createElement("section");
  classList.id = "elements3";
  preview.appendChild(classList);
  var classList0 = document.getElementById("elements3");

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
    img.setAttribute("id", "previewImageSP");
    //img.innerHTML = '<div>おはよう</div>';
    classList0.appendChild(img);
    
    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.name = "slide[]";
    slide1.setAttribute("id", "previewInputSP");
    classList0.appendChild(slide1);

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "slideSP[]";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInputSP");
    classList0.appendChild(slide1);
  };

  console.log('来てます');
  reader.readAsDataURL(file);
  //console.log(file);
}
