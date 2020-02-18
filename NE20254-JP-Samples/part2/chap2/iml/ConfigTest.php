<?php
/**
* Config.php example with IniCommented container
* This container is for PHP .ini files, when you want
* to keep your comments. If you don't use comments, you'd rather
* use the IniFile.php container.
* @author 	Bertrand Mansion <bmansion@mamasam.com>
* @package	Config
*/
// $Id: ConfigTest.php,v 1.1 2005/03/05 08:59:55 rui Exp $

require_once('Config.php');

$datasrc = './config/param.xml';

$phpIni = new Config();
$root =& $phpIni->parseConfig($datasrc, 'XML');
if (PEAR::isError($root)) {
	die($root->getMessage());
}

// Convert your ini file to a php array config

echo '<b>PHPArray</b><br>';
echo '<pre>'.$root->toString('PHPArray', array('name' => 'php_ini')).'</pre>';
echo '<b>Apache</b><br>';
echo '<pre>'.$root->toString('Apache', array('name' => 'php_ini')).'</pre>';
echo '<b>GenericConf</b><br>';
echo '<pre>'.$root->toString('GenericConf', array('name' => 'php_ini')).'</pre>';
echo '<b>IniCommented</b><br>';
echo '<pre>'.$root->toString('IniCommented', array('name' => 'php_ini')).'</pre>';
echo '<b>IniFile</b><br>';
echo '<pre>'.$root->toString('IniFile', array('name' => 'php_ini')).'</pre>';
echo '<b>XML</b><br>';
echo '<pre>'.$root->toString('XML', array('name' => 'php_ini')).'</pre>';
?>
