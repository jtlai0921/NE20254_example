<?php
require_once('DB.php');

$dsn = 'sqlite:////tmp/guestbook2.db';
$dbh = DB::connect($dsn);
if (DB::isError($dbh)) {
    die($dbh->getMessage());
}
$result = $dbh->query('SELECT * FROM guestbook');

while( $row = $result->fetchRow(DB_FETCHMODE_ASSOC)) {
    echo "name={$row['name']} comment={$row['comment']}\n";
}
?>
