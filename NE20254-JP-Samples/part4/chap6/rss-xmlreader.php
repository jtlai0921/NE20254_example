<html><body>
<?php
$xml = new XMLReader(); // XMLReader�Υ��饹���󥹥�������
$xml->open('phpnews.rdf'); // XML�ǡ������ȥ꡼�४���ץ�
$stack = array(); // �����å���������
while ($xml->read()) {   // �ǡ����ɤ߹���
  switch ($xml->nodeType) {
  case XMLREADER_ELEMENT:     // ���ǳ��ϥ����ν���
    if ($xml->name == 'item') {
      $item = array();
    }
    array_push($stack,$xml->name);
    break;
  case XMLREADER_END_ELEMENT:  // ���ǽ�λ�����ν���
    if ($xml->name == 'channel') {
      print <<<EOS
        <a href="{$item['link']}">{$item['title']}</a>
        <table border="1">
EOS;
    }
    if ($xml->name == 'item') {
      print <<<EOS
        <tr><td><a href="{$item['link']}">{$item['title']}
      ({$item['dc:date']})</a><br />
        {$item['description']}</tr>
EOS;
    }
    $name = array_pop($stack);
    break;
  case XMLREADER_TEXT:  // �ƥ����ȥǡ�������
    $name = end($stack);
    switch ($name) {
    case 'title':
    case 'link':
    case 'description':
    case 'dc:date':
      $item[$name] = $xml->value;
      break;
    }
    break;
  }
}
?>
</table></body></html>