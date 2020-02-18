<?php
/*
PHPObject Gateway Configuration File
*/

/*
CLASS DIRECTORIES
- paths to where PHP classes are stored
- paths should end with backslashes, eg. "/www/classes/"
*/
$cfg['classdir'][0]	= "";
//$cfg['classdir'][1]	= "classes/";
//$cfg['classdir'][2]	= "/www/classes/";

/*
USEKEY
- if defined, all requests going through the gateway must provide this key
*/
$cfg['useKey']	= "secret";

/*
DISABLE STANDALONE
- if true, standalone player cannot access this gateway
*/
$cfg['disableStandalone']	= false;

/*
MULTIBYTE SUPPORT
- if true, multiByte characters are supported, but the message sizes will be bigger
*/
$cfg['multiByte']	= true;

?>
