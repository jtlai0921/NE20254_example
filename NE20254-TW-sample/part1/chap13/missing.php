<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html><head>
<title>404 Not Found</title>
</head>
<body>
<?php
$request = ereg_replace('\?.*','',$_SERVER['REQUEST_URI']); // 刪除參數
if ($request == $_SERVER['PHP_SELF']){
  die("This script should not be called directly.");
}

$dir_name = dirname($request);
$base_dir = $_SERVER['DOCUMENT_ROOT'] . $dir_name;

$dir = dir($base_dir) or die("couldn't open requested directory. ");

echo <<<EOS
 找不到指定的檔案: {$_SERVER['REQUEST_URI']}。
 將尋找相似名稱的檔案。
 <hr>
EOS;

$min_point = 50; // 判斷相似的門檻

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

// 支援 Internet Explorer 5.x 的假輸出
printf('%512s', ' '); 
?>
</body></html>
