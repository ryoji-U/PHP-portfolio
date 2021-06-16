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
    var file = $(this).prop('files')[0];
    
    //fileの中のデータが画像であるか確認
    if(!file.type.match('image.*')){
      return;
    }
    
    console.log('ok');
    var fileReader = new FileReader();
    photoPreviewSP0('onChenge',file);
  });
};

//関数
function photoPreviewSP0(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.file;
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
    
    /*
    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.name = "slide[]";
    slide1.setAttribute("id", "previewInputSP");
    classList0.appendChild(slide1);
    */

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "top_image2";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInputSP");
    classList0.appendChild(slide1);
  };

  console.log('来てます');
  reader.readAsDataURL(file);
  //console.log(file);
}
