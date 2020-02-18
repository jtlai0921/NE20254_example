<html><body>
<?php
$xml = new XMLReader(); // XMLReaderのクラスインスタンス生成
$xml->open('phpnews.rdf'); // XMLデータストリームオープン
$stack = array(); // スタック配列初期化
while ($xml->read()) {   // データ読み込み
  switch ($xml->nodeType) {
  case XMLREADER_ELEMENT:     // 要素開始タグの処理
    if ($xml->name == 'item') {
      $item = array();
    }
    array_push($stack,$xml->name);
    break;
  case XMLREADER_END_ELEMENT:  // 要素終了タグの処理
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
  case XMLREADER_TEXT:  // テキストデータ処理
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