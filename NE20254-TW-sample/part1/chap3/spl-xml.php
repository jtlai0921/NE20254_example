<?php 
$xml =<<<EOF
<?xml version='1.0' encoding='big5'?>
<booklist>
 <book>
  <name>PHP4������ ��q��</name>
  </book>
 <book>
  <name>PHP4������ ��Խs</name>
  </book>
</booklist>
EOF;

// ���� SimpleXML �n������
$books = simplexml_load_string($xml, 'SimpleXMLIterator'); 

for ($books->rewind(); $books->valid(); $books->next()) {
  foreach($books->getChildren() as $name => $data) {
    print trim($data)."\n";    // ��X: PHP4������ ��q��
                               //       PHP4������ ��Խs
  }
}
?>
