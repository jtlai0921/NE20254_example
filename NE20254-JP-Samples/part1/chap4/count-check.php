<?php

function check_session($src) {
  $salt = "secret";
  $base = $salt . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'];
  $check = $base . preg_replace("/(.+)\?.*/",'$1',$_SERVER['HTTP_REFERER']);
 
  if (!isset($_SERVER['HTTP_REFERER']) || !isset($_SESSION['check']) || 
      $_SESSION['check'] !=  md5($check)) {
    session_regenerate_id();
    $_SESSION = array();
    $base = $salt . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'];
    $_SESSION['check'] = md5($base . $src);
    print "セッションが開始されました。<br>";
  }
  return ($check);
}

$src = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

session_start();
$check = check_session($src);

if (!isset($_SESSION['cnt'])){
  $_SESSION['cnt']++;
}

print "アクセス回数:".$_SESSION['cnt']++;
?>
<br>
<a href="<?php echo $_SERVER['PHP_SELF'];?>">カウントアップ</a>

<?php
print "<hr>";
print session_id()."<br>";
print $_SERVER['REMOTE_ADDR']."<br>";
print $_SERVER['HTTP_USER_AGENT']."<br>";
print $_SERVER['HTTP_REFERER']."<br>";
print $_SESSION['check']."<br>";
print $check."<br>";
print $src."<br>";
?>
