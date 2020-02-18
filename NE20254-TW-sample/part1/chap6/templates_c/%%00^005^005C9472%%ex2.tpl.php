<?php /* Smarty version 2.6.14, created on 2006-07-12 09:01:23
         compiled from ex2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'ex2.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "colors.conf",'section' => 'Login'), $this);?>

<html>
<title><?php echo $this->_config[0]['vars']['pageTitle']; ?>
</title>
<body bgcolor="<?php echo $this->_config[0]['vars']['bodyBgColor']; ?>
">
<table bgcolor="<?php echo $this->_config[0]['vars']['tableBgColor']; ?>
">
<tr bgcolor="<?php echo $this->_config[0]['vars']['rowBgColor']; ?>
">
 <td><?php echo $this->_tpl_vars['name']; ?>
</td><td><?php echo $this->_tpl_vars['address']; ?>
</td>
<tr>
</table>
<hr />
<?php echo $this->_config[0]['vars']['Footnote']; ?>

</body>
</html>