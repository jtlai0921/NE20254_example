<?php
 /*
  * 密碼檢驗
  */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// 開啟 DB 確認密碼
$dbh = gbdbopen($fn);
if ($dbh == FALSE) {
  echo "DB($fn): 開啟時發生錯誤。<br>";
  include("gbtrailer.php");
  exit;
}
$res = (int)gbdbtblexists($dbh, 'user_tbl');
if (! $res ) {//"GUESTBOOKPASS"
  echo "尚未設定管理員。<br>";
  gbdbclose($dbh);
  include("gbtrailer.php");
  exit;
}

$gpass = gbdbselect($dbh,"user_tbl", "pass", "name = 'admin'");
//if($DEBUG)echo "gpass=\"${gpass['pass']}\"<br>\n";
if ( $gpass['pass'] != "{$_POST['GUESTBOOKPASS']}" ) {
  if ("{$_POST['GUESTBOOKPASS']}" == "") {
    echo "需要指定密碼。<p>";
  } else {
    echo "密碼錯誤。<p>";
  }
  unset($_POST['GUESTBOOKPASS']);
  gbdbclose($dbh);
}
gbdbclose($dbh);
?>
