<html><head>
<title>404 Not Found</title>
</head>
<body>
<?php
$request = ereg_replace('\?.*','',$_SERVER['REQUEST_URI']); // パラメータを削除
if ($request == $_SERVER['PHP_SELF']){
  die("This script should not be called directly.");
}

$dir_name = dirname($request);
$base_dir = $_SERVER['DOCUMENT_ROOT'] . $dir_name;

$dir = dir($base_dir) or die("couldn't open requested directory. ");

echo <<<EOS
 指定された {$_SERVER['REQUEST_URI']} は見つかりません。
 似た名前のファイルを探します。
 <hr>
EOS;

$min_point = 60; // 類似と判断する閾値

while($file = $dir->read()){
  if ($file != '.' && $file != '..' ) {
    $file_path = $base_dir . '/' . $file;
    if(!is_dir($file_path)){
      similar_text($file, $request,$match);
      if ($match>$min_point){
        $uri = $dir_name . '/' . $file;
        echo "<a href=\"$uri\">$uri</a><br>\n";
			}
    }
  }
}

// Microsoft Internet Explorer 5.x 用ダミー出力
printf('%512s', ' '); 
?>
</body></html>
