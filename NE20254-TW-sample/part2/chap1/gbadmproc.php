<?php
/*
 * 執行 DB 管理命令
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

$dbh = gbdbopen($fn);
if ($dbh == FALSE) {
  echo "DB($fn): 開啟時發生錯誤。<br />";
  include("gbtrailer.php");
  exit;
}

// 執行各項指令
switch($_POST['GUESTBOOKFUNC']){
 case "clear":
   // 刪除全部的留言
   $ret = gbdbdelete ($dbh, "note_tbl");
   echo "留言已全部刪除。<p>";
   break;
 case "delete":
   // 刪除指定日數以前的留言
   $days = (int)$_POST['GUESTBOOKARG'];
   $today = time();
   $stadate = $today - $days * 3600 * 24;;
   $condition = "date < $stadate";
   $ret = gbdbdelete ($dbh, "note_tbl", $condition);
   if ( $ret) {
	   echo "已刪除至 $stadate 為止的留言資料。<br />";
   } else {
	   echo "無法刪除至 $stadate 為止的留言資料。<br />";
   }
   break;
 case "change_password":
    // 更新密碼
   $pass = $_POST['GUESTBOOKARG'];
   $ret = gbdbupdate ($dbh, 'user_tbl', 'pass', "'$pass'", "name = 'admin'");
   if (! empty($ret) ) {
     echo "密碼設定失敗 ($ret)。<br />";
   } else {
     echo "密碼設定成功。<br />";
   }
   break;
 case "edit":
   // 開啟編輯留言的表單
   $condition = "date = ${_POST['GUESTBOOKARG']}";
   $entry=gbdbselect($dbh, 'note_tbl', '*', $condition);
   if (! is_array($entry) ) {
     echo "找不到指定的留言 ({$_POST['GUESTBOOKARG']})。<br />";
   } else {
     // 取得資料
     $name = $entry['name'];
     $email = $entry['mail'];
     $comment = $entry['note'];
     $entrydate = $entry['date'];
     // 編輯留言的表單
     include "gbeditform.php";
   }
   unset ($_POST['GUESTBOOKARG']);
   break;
 case "update":
   // 儲存變更內容
   $cols['name'] = "'{$_POST['EditGuestName']}'";
   $cols['mail'] = "'{$_POST['EditGuestEmail']}'";
   $cols['note'] = "'{$_POST['EditGuestComment']}'";
   $cond = "date = {$_POST['GUESTBOOKARG']}";
   $ret = gbdbupdatearray ($dbh, 'note_tbl', $cols, $cond);
   if (! empty($ret) ) {
     echo "留言儲存失敗 ($ret)。<br />";
   } else {
     echo "已成功儲存編輯過的留言。<br />";
   }
   break;
}
gbdbclose($dbh);
?>
