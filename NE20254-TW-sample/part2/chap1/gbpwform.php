<?php
/*
 * 輸入、驗證管理密碼
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

請輸入管理密碼:
<form action="<?php echo $_SERVER['PHP_SELF']."?mode=$mode"?>" method="post">
<?php if (!empty($date)) { ?>
  <input type="hidden" name="GUESTBOOKFUNC" value="edit">
  <input type="hidden" name="GUESTBOOKARG" value="<?php echo $date?>">
<?php } ?>
<input type="password" name="GUESTBOOKPASS">
<input type="submit" value=" Ok ">
</form>
