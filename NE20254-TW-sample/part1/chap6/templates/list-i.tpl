<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset={$encoding}">
  <title>{$pageTitle}</title>
</head>
<body>
<h1>您的訂單</h1>
<br>
<form action="shop-tpl.php" method="POST">
<!--
  {section name=items loop=$id}
-->
 {$name[items]}: {$price[items]} 元 <input type="text" name="{$id[items]}" size="2">個<br />
<!--
    {/section}
-->
<input type="submit" value="送出">
</form>
</body>
</html>
