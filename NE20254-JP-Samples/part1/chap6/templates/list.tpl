<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset={$encoding}">
  <title>{$pageTitle}</title>
</head>
<body>
<h1>ご注文</h1>
<br>
<form action="shop.php" method="POST">
<table>
 <tbody>
<!--
  {section name=items loop=$id}
-->
  <tr>
   <td>{$name[items]}</td>
   <td>{$price[items]}円</td>
   <td><input type="text" name="{$id[items]}" size="2">個</td>
  </tr>
<!--
  {/section}
-->
 </tbody>
</table>
<input type="submit" value="送信">
</form>
</body>
</html>
