<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset={$encoding}">
  <title>{$pageTitle}</title>
</head>
<body>
<h1>±zªº­q³æ</h1>
<br>
<form action="shop-tpl.php">
<table cellpadding="2" cellspacing="2" border="1" width="100%">
<!--
  {section name=items loop=$name}
-->
 <tr>
   <td>{$name[items]}</td><td>{$price[items]}</td>
   <td><input type="text" name="{$id[items]}"></td>
 </tr>
<!--
    {/section}
-->
</table>
<input type="submit">
</form>
</body>
</html>
