<?php
/*
 * 留言用表單
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};
?>
歡迎您造訪本網站。您可填寫以下欄位，留下您的意見。您也能<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=read&days=7">瀏覽</a>過往的留言。

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <font size=-1><tt><b>名稱</b></tt></font><br />
  <input type="text" name="GuestName"><br /><br />
  <font size=-1><tt><b>電子信箱</b></tt></font><br />
  <input type="text" name="GuestEmail" value="<?php echo $_SERVER['EMAIL_ADDR']; ?>"><br /><br />
  <font size=-1><tt><b>留言</b></tt></font><br />
  <textarea name="GuestComment" rows=4 cols=72></textarea><br /><br />
  <center><input type="submit" value=" 登録內容 "></center>
</form>
