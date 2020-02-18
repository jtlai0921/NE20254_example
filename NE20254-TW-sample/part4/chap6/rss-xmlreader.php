<html><body>
<?php
$xml = new XMLReader(); // 建立XMLReader的類別實體
$xml->open('phpnews.rdf'); // 開啟XML串流
$stack = array(); // 堆疊陣列初始化
while ($xml->read()) {   // 匯入資料
  switch ($xml->nodeType) {
  case XMLREADER_ELEMENT:     // 元素開始標記的處理
    if ($xml->name == 'item') {
      $item = array();
    }
    array_push($stack,$xml->name);
    break;
  case XMLREADER_END_ELEMENT:  // 元素結束標記的處理
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
  case XMLREADER_TEXT:  // 處理文字資料
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
