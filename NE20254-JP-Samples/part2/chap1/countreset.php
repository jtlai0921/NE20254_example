#!/usr/bin/php -q
<?php
if ( isset($_SERVER['SERVER_SOFTWARE']) ) {
  echo "Using: {$_SERVER['HTTP_USER_AGENT']} on {$_SERVER['REMOTE_ADDR']}";
  exit;
}

require_once "count.php";

if (! isset($_SERVER['argv'][1]) ) {
  $dbmfn='counter';
} else {
  $dbmfn=$_SERVER['argv'][1];
}
echo "Using counter file: $dbmfn\n";

if (! isset($_SERVER['argv'][2]) ) {
  echo "Usage: ".$_SERVER['argv'][0]." <dbmname> <key> [<value>]\n";
  counterlist($dbmfn);
  echo "\n";
  exit;
}
if ( isset($_SERVER['argv'][2]) ) {
  $key=$_SERVER['argv'][2];
} else {
  $key='/index.html';
}
if ( isset($_SERVER['argv'][3]) ) {
  $value = $_SERVER['argv'][3];
} else {
  $value = 0;
}

$counts = countreset ($dbmfn, $key, $value);
echo "$counts = countreset ($dbmfn, $key, $value)\n";
if ( is_array($counts) ) {
  foreach ($counts as $key => $value) {
    echo "$key = $value\n";
  }
} else {			// ¥Õ¥ª
  echo "¡¦¥©¡¦¥ò¡¦€€¥½¡£¥·¡¦¥Ì¡£¥·¡¦¥½¡¢¥ã¡¢¡Ö¡¢ô¦¡«¡¢¥µ¡¢€€¡×\n";
}
?>
