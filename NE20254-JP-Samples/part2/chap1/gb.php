<?php
//   Original version was found in example programs of
// PHP/FI-2.0 by Rasmus Lerdorf <rasmus@lerdorf.on.ca> in 1997.
// Ported to PHP4 by Jun Kuwamrua <juk@yokohama.email.ne.jp> in 2000.
// Ported to PHP5 with SQLite by Jun Kuwamrua in 2005.
//
//  History:
//      2005-02-09 JuK port to PHP5.
//      2002-02-01 Rui modification for register_globals=Off.
//      2001-10-14 JuK restruct if-blocks.
//      2001-09-30 JuK split into parts.
//      2000-07-19 JuK port to PHP4.
//      1999-04-29 JuK modified for PHP3.
//      1997-05-21 JuK modified to ¥Ë€€¥ï¥¯ì for RCCM web page.
require_once 'gbdb.php';
$DEBUG=0;
?>
<html>
<head>
<title>GuestLog</title>
</head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=x-euc-jp">
<body bgcolor="#ffffff" text="#000000" link="#1760c0" vlink="#107020">
<center>
<img src="guestbook.jpg" border="0" width="200" alt="Guestbook">
</center>
<hr>
<font size ="6">¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼</font>
<font size="3">
<a href="<?php echo $_SERVER['PHP_SELF']; ?>"> [¥ª¥å¥³¥ï] </a>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=read&days=1"> [¥¢¥ï¥Ø€€ </a>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=admin"> [¥¨¥Î¥Ø€€ </a>
</font><br>
<blockquote>
<hr size="1">

<?php
if($DEBUG)include("gbdebug.php");
// ¡¢¥¦¡¢¥ÛPHP¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥Û¥¦¥Í¥È¡¦¥µ¥á¡¢¥Û¥Î€€¥ã¡¢€€þ¿€€¥­¡¢¥Ë DB ¥Õ¥»¡¢¥Í¡¢¥­¡¢¡«¡¢¥±¡£¡×
// ¡£¥Ï¥Ï¥Õ¡¢¥Û¥Õ¥»¥Á¡¼¡¢¥Ò¥¹€€¥å¥¨¥±¡¢¥£¡¢ö¦¥¦¡¢¥Í¡¢ä´¥È¥Ì¥¹¡¢¥Ì¡¢¥±¡£¡×¡£¥Ò
$fl = split( "\.", basename($_SERVER['SCRIPT_NAME']), 2);
$fn = "../data/$fl[0]";
//$fn = "$fl[0]";  // No directory path for PostgreSQL

// DB¥¦¥Û¥Ì¥¡¡£¥½¥¨¥Î¥Ø€€¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢¥Û¥Ê¥ß¥Þ¥½(¥Õ¡¢¥Ê¥ß¥Þ¥½¡¢¥Û¥»ø»ç)
include "gbpwadd.php";

$mode = '';
if (! empty($_GET['mode']) ) $mode = $_GET['mode'];
     
switch ($mode) {
 case 'read':
	 // ¥ª¥å¥³¥ï¡¢¥Û¥Ë¥Î¡¢¡¬¥¹¥ß¡¢¥­
	 include "gbread.php";
	 break;
 case 'admin':
	 // ¥¨¥Î¥Ø€€¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢¥Û¥¦¥Û¥Ì¥¡
	 include "gbpwchk.php";
	 if (!isset($_POST['GUESTBOOKPASS'])) {
		 // ¥¨¥Î¥Ø€€¥à¡¦¥±¡¦þ£¥·¡¦¥Î¥Ë€€¥Þ¥¹€€¡¼
		 include "gbpwform.php";
	 } else {
		 // ¥ª¥å¥³¥ï¡¢¥Û¥Ï¥à¥±¥±
		 if (!$_POST['GUESTBOOKFUNC']){
			 // ¥ª¥å¥³¥ï¡¢¥Û¥Ï¥à¥±¥±¥Ø¥à¡¦¥æ¡¦¥¥¡£¥·¡¦à
			 include "gbadmform.php";
		 } else {
			 // ¥ª¥å¥³¥ï¡¢¥Û¥Ï¥à¥±¥±¥¹ðÏý
			 include "gbadmproc.php";
		 }
	 }
	 break;
 default:
	 unset($_POST['GUESTBOOKPASS']);
	 
	 // ¥ª¥å¥³¥ï
	 if (!$_POST['GuestComment']) {
		 // ¥ª¥å¥³¥ï¥Ø¥à¡¦¥æ¡¦¥¥¡£¥·¡¦à(¥³¥Ì¥¹ò¦¥Û¡¦¥ì¡£¥·¡¦¥¯)
		 include "gbform.php";
	 } else {
		 // ¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼¡¢¥Ò¥¹€€¥å¥±€€¡¬
		 include "gbwrite.php";
		 // ¥Æ¥¨¥Ê€€¥ä¡¢¥ê¡¦â£¥·¡¦öÃ€€¥æ
		 include "gbmail.php";
	 }
	 break;
}

include "gbtrailer.php";
?>
