<?php 
$xml =<<<EOF
<?xml version='1.0' encoding='EUC-JP'?>
<booklist>
 <book>
  <name>PHP4徹底攻略 改訂版</name>
  </book>
 <book>
  <name>PHP4徹底攻略 実戦編</name>
  </book>
</booklist>
EOF;

// SimpleXML要素オブジェクト生成
$books = simplexml_load_string($xml, 'SimpleXMLIterator'); 

for ($books->rewind(); $books->valid(); $books->next()) {
  foreach($books->getChildren() as $name => $data) {
    print trim($data)."\n";    // 出力: PHP4徹底攻略 改訂版
                               //      PHP4徹底攻略 実戦編
  }
}
?>
