<?php
//   Original version was found in example programs of
// PHP/FI-2.0 by Rasmus Lerdorf <rasmus@lerdorf.on.ca> in 1997.
// Ported to PHP4 by Jun Kuwamrua <juk@yokohama.email.ne.jp> in 2000.
// Ported to PHP5 with SQLite by Jun Kuwamrua in 2005.
// Translated to Traditional Chinese by Tiberius Teng <tiberiusteng@msn.com>
//      for DrMaster book PHP5 徹底研究專業篇 in 2006.
//
//  History:
//      2006-08-07 Tib translated to 繁體中文 (Traditional Chinese)
//      2005-02-09 JuK port to PHP5.
//      2002-02-01 Rui modification for register_globals=Off.
//      2001-10-14 JuK restruct if-blocks.
//      2001-09-30 JuK split into parts.
//      2000-07-19 JuK port to PHP4.
//      1999-04-29 JuK modified for PHP3.
//      1997-05-21 JuK modified to 日文 for RCCM web page.
require_once 'gbdb.php';
$DEBUG=0;
?>
<html>
<head>
<title>GuestLog</title>
</head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<body bgcolor="#ffffff" text="#000000" link="#1760c0" vlink="#107020">
<center>
<img src="guestbook.jpg" border="0" width="200" alt="Guestbook">
</center>
<hr>
<font size ="6">Guestlog</font>
<font size="3">
<a href="<?php echo $_SERVER['PHP_SELF']; ?>"> [留言] </a>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=read&days=1"> [瀏覽] </a>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=admin"> [管理] </a>
</font><br>
<blockquote>
<hr size="1">

<?php
if($DEBUG)include("gbdebug.php");
// 將這個 PHP 檔的副檔名部分刪除，當作 DB 名稱
// (也可以換成其他名稱)
$fl = split( "\.", basename($_SERVER['SCRIPT_NAME']), 2);
$fn = "c:/temp/$fl[0]";
//$fn = "$fl[0]";  // No directory path for PostgreSQL

// 確認 DB / 設定管理密碼 (若尚未設定)
include "gbpwadd.php";

$mode = '';
if (! empty($_GET['mode']) ) $mode = $_GET['mode'];
     
switch ($mode) {
 case 'read':
	 // 讀取記錄內容
	 include "gbread.php";
	 break;
 case 'admin':
	 // 確認管理密碼
	 include "gbpwchk.php";
	 if (!isset($_POST['GUESTBOOKPASS'])) {
		 // 管理密碼輸入格式
		 include "gbpwform.php";
	 } else {
		 // 變更留言內容
		 if (!$_POST['GUESTBOOKFUNC']){
			 // 變更留言內容的表單
			 include "gbadmform.php";
		 } else {
			 // 執行變更留言內容
			 include "gbadmproc.php";
		 }
	 }
	 break;
 default:
	 unset($_POST['GUESTBOOKPASS']);
	 
	 // 留言
	 if (!$_POST['GuestComment']) {
		 // 留言用表單(首頁)
		 include "gbform.php";
	 } else {
		 // 寫入 guestlog
		 include "gbwrite.php";
		 // 傳送電子郵件給管理員
		 include "gbmail.php";
	 }
	 break;
}

include "gbtrailer.php";
?>
