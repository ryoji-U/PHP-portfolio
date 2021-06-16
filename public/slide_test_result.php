<?php

$result = $_POST;
$files = $_FILES;
var_dump($files);
echo "<br>";

echo $files["file"]["tmp_name"][0];
echo "<br>";


/*ここから */
$before_file = $files["file"]["tmp_name"][0];
$original_image = @imagecreatefromjpeg($before_file);
$canvas = @imagecreatetruecolor(450,300);
@imagecopyresampled($canvas,$original_image,0,0,0,0,450,300,450,300);

@imageresolution($canvas,72);



@imagejpeg($canvas,"../images/dpi.jpg");

//echo '<img src="'.$canvas.'">';







//qiita

/*ここから*//*
$before_file = $files["file"]["tmp_name"][0];

List($original_w,$original_h,$type) = @getimagesize($before_file);
print_r(getimagesize($before_file));

$rate = ($original_w / 450);
if($rate > 1){
  $w = floor((1 / $rate) * $original_w);
  $h = floor((1 / $rate) * $original_h);
  echo "小さくしました";
  echo '高さ:'.$h;
}else{
  $w = $original_w;
  $h = $original_h;
  echo "そのままでも大丈夫です";
}

switch($type){
  case IMAGETYPE_JPEG:
    $original_image = @imagecreatefromjpeg($before_file);
  break;
  case IMAGETYPE_PNG:
    $original_image = @imagecreatefrompng($before_file);
  break;
  default:
  throw new RuntimeException('対応していないファイル形式です。',$type);
}

$canvas = @imagecreatetruecolor($w,$h);
@imagecopyresampled($canvas,$original_image,0,0,0,0,$w,$h,$original_w,$original_h);

$path = '../images/';
$resize_path = $path."after.jpg";

switch($type){
  case IMAGETYPE_JPEG:
    @imagejpeg($canvas,$resize_path);
  break;
  case IMAGETYPE_PNG:
    @imagepng($canvas,$resize_path,9);
  break;
}

@imagedestroy($original_image);
@imagedestroy($canvas);
*/


?>
<html>
<head>
</head>
<body>


</body>
</html>