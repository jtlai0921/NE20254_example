<?php
define('CMD_LIST', 1);
define('CMD_SHIP', 2);
define('CMD_LAST', 3);

define('BROWSER_NON_MOBILE', 1);
define('BROWSER_MOBILE', 2);

define('DSN','sqlite://dummy:@localhost//tmp/shop.db?mode=0644');

$templateMap = array(
  CMD_LIST => array(
   BROWSER_NON_MOBILE => 'list.tpl', BROWSER_MOBILE => 'list.tpl'),
  CMD_SHIP => array(
   BROWSER_NON_MOBILE => 'ship.tpl', BROWSER_MOBILE => 'ship.tpl'),
  CMD_LAST => array(
   BROWSER_NON_MOBILE => 'last.tpl', BROWSER_MOBILE => 'last.tpl'));
?>
