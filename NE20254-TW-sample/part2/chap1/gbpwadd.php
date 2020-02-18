<?php
/*
 * Guestlog DB 的密碼認證 / 設定
 *
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// 確認是否有guestlogDB
if ( gbdbexists($fn) === false ) {
  // 沒有DB
  echo "<p>沒有guestlogDB($fn)，需建立一個。</p>\n";
  // 如果沒有DB的話，建立一個新的
  $dbh = gbdbopen($fn);
  if ($dbh === false) {
    echo "無法建立guestlogDB($fn)。<br />";
  } else {
    if ( gbdbinit ($dbh) ) {
      gbdbclose($dbh);
      echo <<<EOF1
已重新建立guestlogDB。請輸入管理用密碼。
今後只要執行此 guestlog 管理工作都需要輸入這個密碼
<p><center>
<form action="{$_SERVER['PHP_SELF']}" method="post">
<input type="password" name="GUESTBOOKPASS">
<input type="submit" value=" 確定 ">
</form>
</center></p>
EOF1;
    } else {
      echo "guestlog 建立失敗。<br />";
    }
	}
  include "gbtrailer.php";
  exit;
} else {
  $dbh = gbdbopen($fn);
  if ($dbh === false) {
    echo "無法寫入 guestlogDB ($fn)。<br />";
    include("gbtrailer.php");
    exit;
  } else {
    $res = (int)gbdbtblexists($dbh, 'user_tbl');
    if (! $res ) {//"GUESTBOOKPASS"
	    // 在 DB 儲存密碼
	    $tuple = array( 'adm' => 1,
                      'name' => 'admin',
                      'pass' => $_POST['GUESTBOOKPASS']
                      );
	    
	    $ret = gbdbinsert($dbh, 'user_tbl', $tuple );
	    if ( empty($ret) ) {
        echo "密碼設定成功！<br />";
	    } else {
        echo "ERROR: 密碼設定失敗！<br />";
	    }
    }
  }
  gbdbclose($dbh);
}
?>
