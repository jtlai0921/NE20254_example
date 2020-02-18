<?php
require_once('DB.php');

$dsn = 'sqlite:////tmp/guestbook2.db';
$data = array('jiro'=>'test comment 1.',
              'saburo'=>'test comment 2.');

$dbh = DB::connect($dsn);
$fields = array('name','comment');
$sth = $dbh->autoPrepare('guestbook', $fields, DB_AUTOQUERY_INSERT);

foreach ($data as $name => $comment) {
    $res = $dbh->execute($sth, array($name, $comment));
    if (DB::isError($res)) { 
        die($res->getMessage());
    }    
}
?>
