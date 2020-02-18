<?php
require_once 'XML/Parser/Simple.php';
/*
 *  Custom XML Simple Parser
 *
 *    Example usage:
 *	--
 *	$x = new MyParser();
 *	$res = $x->setInputFile("param.xml");
 *	$res = $x->parse();
 *	$eln = $x->getElementNames();
 *	while ( list($k, $v) = each($eln) ) {
 *	    $val = $x->getElementOf( $v );
 *	    echo "$k: ".$val['data']."<br>\n";
 *	    var_dump( $x->getElementAttribsOf( $v ) );
 *	}
 *	--
 *
 *    Example file(param.xml):
 *	--
 *	<?xml version="1.0" encoding="UTF-8" ?>
 *	<path_info>
 *	<directory_uri label="directory uri">%7Ewww/Udon<directory_uri>
 *	<directory_path label="directory path">/www/Udon</directory_path>
 *	<original_directory label="original directory">data</original_directory>
 *	</path_info>
 *	--
 */

class MyParser extends XML_Parser_Simple {
    var $_name = array();
    var $_element = array();

    function MyParser() {
        $this->XML_Parser_Simple();
    }
    function handleElement($name, $attribs, $data) {
	$elem = array();
	$elem['depth'] = $this->getCurrentDepth();
	$elem['name'] = $name;
	$elem['data'] = $data;
	$elem['attribs'] = $attribs;
	$this->_element[$name] = $elem;
	$this->_name[] = $name;
    }

    function getElementNames2() {
	$names = array();
	while (list($k, $v) = each($this->_element)) {
	    $names[] = $k;
	}
	reset($this->_element);
	return $names;
    }
    function getElementNames() {
	return $this->_name;
    }
    function getElementOf( $name ) {
	return $this->_element[$name];
    }
    function getElementDepthOf( $name ) {
	return $this->_element[$name]['depth'];
    }
    function getElementDataOf( $name ) {
	return $this->_element[$name]['data'];
    }
    function getElementAttribsOf( $name ) {
	return $this->_element[$name]['attribs'];
    }
}
?>
