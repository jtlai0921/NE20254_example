<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset={$encoding}">
  <title>{$pageTitle}</title>
</head>
<body>
<h1>���Ϥ���Ȼ�ʧ��ˡ</h1>
  <form action="shop.php" method="POST">
     ��̾��:<input type="text" name="yourname" size="40" value="{$yourname}"><br />
     ȯ����:<input type="text" name="address" size="40" value="{$address}"><br />
     ��ʧ����ˡ:
      ͹�ؿ���<input type="radio" name="payment" value="poffice" checked> 
      ��Կ���<input type="radio" name="payment" value="bank">
     <input type="submit" value="����">
  </form>
</body></html>
