<?php 

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <title>udastagram</title>
</head>
<body>
<section id="formphp">
<section class="spacer_50"></section>

<form action="slide_test_result.php" method="post" enctype="multipart/form-data">
    <input type="file" value="ファイルを選択" name="file[]" accept="image/*;capture=camera" multiple>
    <input type="submit" value="送信">
</form>


<section class="spacer_50"></section>
</section>

</body>
</html>