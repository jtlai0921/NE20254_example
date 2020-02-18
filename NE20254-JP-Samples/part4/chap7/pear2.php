<?php
require_once('DB.php');

$dsn = 'sqlite:////tmp/guestbook2.db';
$data = array('jiro'=>'test comment 1.',
              'saburo'=>'test comment 2.');

$dbh = DB::connect($dsn);
$sth = $dbh->prepare('INSERT INTO guestbook VALUES (?,?)');

foreach ($data as $name => $comment) {
    $res = $dbh->execute($sth, array($name, $comment));
    if (DB::isError($res)) { 
        die($res->getMessage());
    }    
}
?>
