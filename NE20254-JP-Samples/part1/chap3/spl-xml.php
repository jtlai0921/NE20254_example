<?php 
$xml =<<<EOF
<?xml version='1.0' encoding='EUC-JP'?>
<booklist>
 <book>
  <name>PHP4Ű�칶ά ������</name>
  </book>
 <book>
  <name>PHP4Ű�칶ά ������</name>
  </book>
</booklist>
EOF;

// SimpleXML���ǥ��֥�����������
$books = simplexml_load_string($xml, 'SimpleXMLIterator'); 

for ($books->rewind(); $books->valid(); $books->next()) {
  foreach($books->getChildren() as $name => $data) {
    print trim($data)."\n";    // ����: PHP4Ű�칶ά ������
                               //      PHP4Ű�칶ά ������
  }
}
?>
