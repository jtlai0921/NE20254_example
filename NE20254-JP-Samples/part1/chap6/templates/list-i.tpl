<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset={$encoding}">
  <title>{$pageTitle}</title>
</head>
<body>
<h1>����ʸ</h1>
<br>
<form action="shop.php" method="POST">
<!--
  {section name=items loop=$id}
-->
 {$name[items]}: {$price[items]}�� <input type="text" name="{$id[items]}" size="2">��<br />
<!--
    {/section}
-->
<input type="submit" value="����">
</form>
</body>
</html>
