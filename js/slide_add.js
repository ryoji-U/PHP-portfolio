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
    if(files.length > 4){
      alert('画像の枚数を4枚以下にして下さい。');
    }else{
      if(!files[0].type.match(/image/)){
        alert('ここには画像のみを挿入してください。');
      }else if(!files[0].name.match(/jpg/) && !files[0].name.match(/jpeg/) && !files[0].name.match(/png/)){
        alert('jpgまたはpng画像を挿入してください。');
      }else{
        photoPreview0('onChenge',files[0]);
      }
      if(files[1]){
        if(!files[1].type.match(/image/)){
          alert('ここには画像のみを挿入してください。');
        }else if(!files[1].name.match(/jpg/) && !files[1].name.match(/jpeg/) && !files[1].name.match(/png/)){
          alert('jpgまたはpng画像を挿入してください。');
        }else{
          photoPreview1('onChenge',files[1]);
        }
      }
      if(files[2]){
        if(!files[2].type.match(/image/)){
          alert('ここには画像のみを挿入してください。');
        }else if(!files[2].name.match(/jpg/) && !files[2].name.match(/jpeg/) && !files[2].name.match(/png/)){
          alert('jpgまたはpng画像を挿入してください。');
        }else{
          photoPreview2('onChenge',files[2]);
        }
      }
      if(files[3]){
        if(!files[3].type.match(/image/)){
          alert('ここには画像のみを挿入してください。');
        }else if(!files[3].name.match(/jpg/) && !files[3].name.match(/jpeg/) && !files[3].name.match(/png/)){
          alert('jpgまたはpng画像を挿入してください。');
        }else{
          photoPreview3('onChenge',files[3]);
        }
      }
      //if(files[4])photoPreview4('onChenge',files[4]);
      //if(files[5])photoPreview5('onChenge',files[5]);
      //if(files[6])photoPreview6('onChenge',files[6]);
      //if(files[7])photoPreview7('onChenge',files[7]);
    }
});

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
    slide1.name = "slide[]";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInput");
    classList0.appendChild(slide1);
  };

  reader.readAsDataURL(file);
  //console.log(file);
}

function photoPreview1(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[1];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewArea");
  var previewImage = document.getElementById("previewImage");
  var previewInput = document.getElementById("previewInput");

  var classList = document.createElement("section");
  classList.id = "elements1";
  preview.appendChild(classList);
  var classList1 = document.getElementById("elements1");

  if(previewImage != null) {
    classList1.removeChild(previewImage);
  }
  //inputタグ削除
  if(previewInput != null) {
    classList1.removeChild(previewInput);
  }
  
  reader.onload = function(event) {
    var img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "previewImage");
    //img.innerHTML = '<div>おはよう</div>';
    classList1.appendChild(img);

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "slide[]";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInput");
    classList1.appendChild(slide1);
  };

  reader.readAsDataURL(file);
  //console.log(file);
}

function photoPreview2(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[1];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewArea");
  var previewImage = document.getElementById("previewImage");
  var previewInput = document.getElementById("previewInput");

  var classList = document.createElement("section");
  classList.id = "elements2";
  preview.appendChild(classList);
  var classList2 = document.getElementById("elements2");

  if(previewImage != null) {
    classList2.removeChild(previewImage);
  }
  //inputタグ削除
  if(previewInput != null) {
    classList2.removeChild(previewInput);
  }
  
  reader.onload = function(event) {
    var img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "previewImage");
    //img.innerHTML = '<div>おはよう</div>';
    classList2.appendChild(img);

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "slide[]";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInput");
    classList2.appendChild(slide1);
  };

  reader.readAsDataURL(file);
  //console.log(file);
}

function photoPreview3(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[1];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewArea");
  var previewImage = document.getElementById("previewImage");
  var previewInput = document.getElementById("previewInput");

  var classList = document.createElement("section");
  classList.id = "elements3";
  preview.appendChild(classList);
  var classList3 = document.getElementById("elements3");

  if(previewImage != null) {
    classList3.removeChild(previewImage);
  }
  //inputタグ削除
  if(previewInput != null) {
    classList3.removeChild(previewInput);
  }
  
  reader.onload = function(event) {
    var img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "previewImage");
    //img.innerHTML = '<div>おはよう</div>';
    classList3.appendChild(img);

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "slide[]";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInput");
    classList3.appendChild(slide1);
  };

  reader.readAsDataURL(file);
  //console.log(file);
}

function photoPreview4(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[1];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewArea");
  var previewImage = document.getElementById("previewImage");
  var previewInput = document.getElementById("previewInput");

  var classList = document.createElement("section");
  classList.id = "elements4";
  preview.appendChild(classList);
  var classList4 = document.getElementById("elements4");

  if(previewImage != null) {
    classList4.removeChild(previewImage);
  }
  //inputタグ削除
  if(previewInput != null) {
    classList4.removeChild(previewInput);
  }
  
  reader.onload = function(event) {
    var img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "previewImage");
    //img.innerHTML = '<div>おはよう</div>';
    classList4.appendChild(img);

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "slide[]";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInput");
    classList4.appendChild(slide1);
  };

  reader.readAsDataURL(file);
  //console.log(file);
}

function photoPreview5(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[1];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewArea");
  var previewImage = document.getElementById("previewImage");
  var previewInput = document.getElementById("previewInput");

  var classList = document.createElement("section");
  classList.id = "elements5";
  preview.appendChild(classList);
  var classList5 = document.getElementById("elements5");

  if(previewImage != null) {
    classList5.removeChild(previewImage);
  }
  //inputタグ削除
  if(previewInput != null) {
    classList5.removeChild(previewInput);
  }
  
  reader.onload = function(event) {
    var img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "previewImage");
    //img.innerHTML = '<div>おはよう</div>';
    classList5.appendChild(img);

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "slide[]";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInput");
    classList5.appendChild(slide1);
  };

  reader.readAsDataURL(file);
  //console.log(file);
}

function photoPreview6(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[1];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewArea");
  var previewImage = document.getElementById("previewImage");
  var previewInput = document.getElementById("previewInput");

  var classList = document.createElement("section");
  classList.id = "elements6";
  preview.appendChild(classList);
  var classList6 = document.getElementById("elements6");

  if(previewImage != null) {
    classList6.removeChild(previewImage);
  }
  //inputタグ削除
  if(previewInput != null) {
    classList6.removeChild(previewInput);
  }
  
  reader.onload = function(event) {
    var img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "previewImage");
    //img.innerHTML = '<div>おはよう</div>';
    classList6.appendChild(img);

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "slide[]";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInput");
    classList6.appendChild(slide1);
  };

  reader.readAsDataURL(file);
  //console.log(file);
}

function photoPreview7(event, f = null) {
  var file = f;
  if(file === null){
      file = event.target.files[1];
  }
  var reader = new FileReader();
  var preview = document.getElementById("previewArea");
  var previewImage = document.getElementById("previewImage");
  var previewInput = document.getElementById("previewInput");

  var classList = document.createElement("section");
  classList.id = "elements7";
  preview.appendChild(classList);
  var classList7 = document.getElementById("elements7");

  if(previewImage != null) {
    classList7.removeChild(previewImage);
  }
  //inputタグ削除
  if(previewInput != null) {
    classList7.removeChild(previewInput);
  }
  
  reader.onload = function(event) {
    var img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "previewImage");
    //img.innerHTML = '<div>おはよう</div>';
    classList7.appendChild(img);

    var slide1 = document.createElement("input");
    slide1.type = "hidden";
    slide1.id = "test";
    slide1.name = "slide[]";
    slide1.value = file.name;
    slide1.setAttribute("id", "previewInput");
    classList7.appendChild(slide1);
  };

  reader.readAsDataURL(file);
  //console.log(file);
}