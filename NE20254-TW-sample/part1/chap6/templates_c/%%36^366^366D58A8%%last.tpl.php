<?php /* Smarty version 2.6.14, created on 2006-07-12 17:41:57
         compiled from last.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $this->_tpl_vars['encoding']; ?>
">
  <title><?php echo $this->_tpl_vars['pageTitle']; ?>
</title>
</head>
<body>
<h1>購物完畢</h1>

<pre>
   謝謝惠顧!
   
  姓名:  <?php echo $this->_tpl_vars['yourname']; ?>

  合計金額:  <?php echo $this->_tpl_vars['total']; ?>
 元
  地址: <?php echo $this->_tpl_vars['address']; ?>

  付款方式: <?php echo $this->_tpl_vars['payment']; ?>

</pre>
<a href="shop-tpl.php">繼續購物</a>
</body></html>