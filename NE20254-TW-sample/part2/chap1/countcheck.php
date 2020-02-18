#!/usr/bin/php -q
<?php
if ( isset($_SERVER['SERVER_SOFTWARE']) ) {
  echo "Using: {$_SERVER['HTTP_USER_AGENT']} on {$_SERVER['REMOTE_ADDR']}";
  exit;
}

require_once "count.php";

if ($_SERVER['argv'][1] == "") {
  $dbmfn='counter';
} else {
  $dbmfn=$_SERVER['argv'][1];
}
echo "Using counter file: $dbmfn\n";

$counts = countlist($dbmfn);
if ( is_array($counts) ) {
  $total=0;
  $i=0;
  foreach ($counts as $key => $value) {
    echo "$key = $value\n";
    $total+=$value;
    $i++;
  }
  echo "Totaly ".$i." key(s) in the file and ".$total." accesses.\n";
} else {                        // ̵
  echo "No counter data exists.\n";
}
?>
