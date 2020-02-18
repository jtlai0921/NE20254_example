<?php /* Smarty version 2.6.14, created on 2006-07-12 13:10:55
         compiled from ex4.tpl */ ?>
<?php unset($this->_sections['users']);
$this->_sections['users']['name'] = 'users';
$this->_sections['users']['loop'] = is_array($_loop=$this->_tpl_vars['cid']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['users']['show'] = true;
$this->_sections['users']['max'] = $this->_sections['users']['loop'];
$this->_sections['users']['step'] = 1;
$this->_sections['users']['start'] = $this->_sections['users']['step'] > 0 ? 0 : $this->_sections['users']['loop']-1;
if ($this->_sections['users']['show']) {
    $this->_sections['users']['total'] = $this->_sections['users']['loop'];
    if ($this->_sections['users']['total'] == 0)
        $this->_sections['users']['show'] = false;
} else
    $this->_sections['users']['total'] = 0;
if ($this->_sections['users']['show']):

            for ($this->_sections['users']['index'] = $this->_sections['users']['start'], $this->_sections['users']['iteration'] = 1;
                 $this->_sections['users']['iteration'] <= $this->_sections['users']['total'];
                 $this->_sections['users']['index'] += $this->_sections['users']['step'], $this->_sections['users']['iteration']++):
$this->_sections['users']['rownum'] = $this->_sections['users']['iteration'];
$this->_sections['users']['index_prev'] = $this->_sections['users']['index'] - $this->_sections['users']['step'];
$this->_sections['users']['index_next'] = $this->_sections['users']['index'] + $this->_sections['users']['step'];
$this->_sections['users']['first']      = ($this->_sections['users']['iteration'] == 1);
$this->_sections['users']['last']       = ($this->_sections['users']['iteration'] == $this->_sections['users']['total']);
?>
 <?php echo $this->_sections['users']['rownum']; ?>
,<?php echo $this->_tpl_vars['cid'][$this->_sections['users']['index']]; ?>
,<?php echo $this->_tpl_vars['name'][$this->_sections['users']['index']]; ?>
<br />
<?php endfor; else: ?>
 迴圈用陣列尚未定義。
<?php endif; ?>
進行 <?php echo $this->_sections['users']['total']; ?>
 次迴圈了。