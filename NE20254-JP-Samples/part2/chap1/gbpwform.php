<?php
/*
 * ¥¨¥Î¥Ø€€¥à¡¦¥±¡¦þ£¥·¡¦¥Î¥Ë€€¥Þ¥¹€€¡¼
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

if (! empty($_SERVER['argv'][1]) ) {
	$date = $_SERVER['argv'][1];
} else {
    if (! empty($_GET['date']) ) {
        $date = $_GET['date'];
    }
}
?>

¥¨¥Î¥Ø€€¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢€€€€¥Þ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢¡£¥¡
<form action="<?php echo $_SERVER['PHP_SELF']."?mode=$mode"?>" method="post">
<?php if (!empty($date)) { ?>
  <input type="hidden" name="GUESTBOOKFUNC" value="edit">
  <input type="hidden" name="GUESTBOOKARG" value="<?php echo $date?>">
<?php } ?>
<input type="password" name="GUESTBOOKPASS">
<input type="submit" value=" Ok ">
</form>
