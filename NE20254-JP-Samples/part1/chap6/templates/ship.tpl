<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset={$encoding}">
  <title>{$pageTitle}</title>
</head>
<body>
<h1>お届け先と支払方法</h1>
  <form action="shop.php" method="POST">
     お名前:<input type="text" name="yourname" size="40" value="{$yourname}"><br />
     発送先:<input type="text" name="address" size="40" value="{$address}"><br />
     支払い方法:
      郵便振替<input type="radio" name="payment" value="poffice" checked> 
      銀行振込<input type="radio" name="payment" value="bank">
     <input type="submit" value="送信">
  </form>
</body></html>
