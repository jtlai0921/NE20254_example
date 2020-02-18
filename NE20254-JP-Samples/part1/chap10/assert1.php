<?php
$a = array('msg'=>'Hello', 'value' => array(1,2,3));

function assert_cb($file, $line, $code) {
  global $a;
  echo "assert: $file:$line $code<br />\n";
  var_dump($a);
  exit;
}

assert("\$a['msg']=='Foo'");
?>
