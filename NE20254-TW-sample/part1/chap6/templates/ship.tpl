<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset={$encoding}">
  <title>{$pageTitle}</title>
</head>
<body>
<h1>配送地點和付款方式</h1>
  <form action="shop-tpl.php" method="POST">
     姓名:<input type="text" name="yourname" size="40" value="{$yourname}"><br />
     地址:<input type="text" name="address" size="40" value="{$address}"><br />
     付款方式:
      郵局劃撥<input type="radio" name="payment" value="poffice" checked> 
      銀行轉帳<input type="radio" name="payment" value="bank">
     <input type="submit" value="送出">
  </form>
</body></html>
