<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset={$encoding}">
  <title>{$pageTitle}</title>
</head>
<body>
<h1>§¥√Ì ∏</h1>
<br>
<form action="shop.php">
<pre>
<!--
  {section name=items loop=$name}
-->


   {$name[items]}</td><td>{$price[items]}</td>
   <td><input type="text" name="{$id[items]}"></td>
 </tr>
<!--
    {/section}
-->
</pre>
<input type="submit">
</form>
</body>
</html>
