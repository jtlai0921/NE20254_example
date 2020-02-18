<?php 
$xml =<<<EOF
<?xml version='1.0' encoding='big5'?>
<booklist>
 <book>
  <name>PHP4徹底攻略 改訂版</name>
  </book>
 <book>
  <name>PHP4徹底攻略 實戰編</name>
  </book>
</booklist>
EOF;

// 產生 SimpleXML 要素物件
$books = simplexml_load_string($xml, 'SimpleXMLIterator'); 

for ($books->rewind(); $books->valid(); $books->next()) {
  foreach($books->getChildren() as $name => $data) {
    print trim($data)."\n";    // 輸出: PHP4徹底攻略 改訂版
                               //       PHP4徹底攻略 實戰編
  }
}
?>
