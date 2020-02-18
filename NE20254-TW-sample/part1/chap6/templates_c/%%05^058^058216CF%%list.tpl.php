<?php /* Smarty version 2.6.14, created on 2006-07-12 17:12:24
         compiled from list.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $this->_tpl_vars['encoding']; ?>
">
  <title><?php echo $this->_tpl_vars['pageTitle']; ?>
</title>
</head>
<body>
<h1>您的訂單</h1>
<br>
<form action="shop-tpl.php" method="POST">
<table>
 <tbody>
<!--
  <?php unset($this->_sections['items']);
$this->_sections['items']['name'] = 'items';
$this->_sections['items']['loop'] = is_array($_loop=$this->_tpl_vars['id']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['items']['show'] = true;
$this->_sections['items']['max'] = $this->_sections['items']['loop'];
$this->_sections['items']['step'] = 1;
$this->_sections['items']['start'] = $this->_sections['items']['step'] > 0 ? 0 : $this->_sections['items']['loop']-1;
if ($this->_sections['items']['show']) {
    $this->_sections['items']['total'] = $this->_sections['items']['loop'];
    if ($this->_sections['items']['total'] == 0)
        $this->_sections['items']['show'] = false;
} else
    $this->_sections['items']['total'] = 0;
if ($this->_sections['items']['show']):

            for ($this->_sections['items']['index'] = $this->_sections['items']['start'], $this->_sections['items']['iteration'] = 1;
                 $this->_sections['items']['iteration'] <= $this->_sections['items']['total'];
                 $this->_sections['items']['index'] += $this->_sections['items']['step'], $this->_sections['items']['iteration']++):
$this->_sections['items']['rownum'] = $this->_sections['items']['iteration'];
$this->_sections['items']['index_prev'] = $this->_sections['items']['index'] - $this->_sections['items']['step'];
$this->_sections['items']['index_next'] = $this->_sections['items']['index'] + $this->_sections['items']['step'];
$this->_sections['items']['first']      = ($this->_sections['items']['iteration'] == 1);
$this->_sections['items']['last']       = ($this->_sections['items']['iteration'] == $this->_sections['items']['total']);
?>
-->
  <tr>
   <td><?php echo $this->_tpl_vars['name'][$this->_sections['items']['index']]; ?>
</td>
   <td><?php echo $this->_tpl_vars['price'][$this->_sections['items']['index']]; ?>
 元</td>
   <td><input type="text" name="<?php echo $this->_tpl_vars['id'][$this->_sections['items']['index']]; ?>
" size="2">個</td>
  </tr>
<!--
  <?php endfor; endif; ?>
-->
 </tbody>
</table>
<input type="submit" value="送出">
</form>
</body>
</html>