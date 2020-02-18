<?php
require_once 'rssGen.php';
require_once('DB.php');
define('DSN','sqlite://dummy:@localhost//tmp/phpnews.db?mode=0644');

$rss = new rssGen('PHPニュース', 'http://www.example.com/','PHP関連ニュース');

$db = DB::connect(DSN, false) or die('db connection failed.');
$result = $db->query('SELECT * from news') or die('Query faild.');

while ($result->fetchInto($data, DB_FETCHMODE_ASSOC)) {
  $rss->addItem($data['title'], $data['link'], $data['content'], $data['date']);
}

print $rss->saveXML();
?>
