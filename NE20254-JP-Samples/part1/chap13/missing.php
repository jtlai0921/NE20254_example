<html><head>
<title>404 Not Found</title>
</head>
<body>
<?php
$request = ereg_replace('\?.*','',$_SERVER['REQUEST_URI']); // �ѥ�᡼������
if ($request == $_SERVER['PHP_SELF']){
  die("This script should not be called directly.");
}

$dir_name = dirname($request);
$base_dir = $_SERVER['DOCUMENT_ROOT'] . $dir_name;

$dir = dir($base_dir) or die("couldn't open requested directory. ");

echo <<<EOS
 ���ꤵ�줿 {$_SERVER['REQUEST_URI']} �ϸ��Ĥ���ޤ���
 ����̾���Υե������õ���ޤ���
 <hr>
EOS;

$min_point = 60; // �����Ƚ�Ǥ�������

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

// Microsoft Internet Explorer 5.x �ѥ��ߡ�����
printf('%512s', ' '); 
?>
</body></html>
