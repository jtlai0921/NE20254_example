<?php
/*
 *  config_util
 *  --------------------
 *   File:    config_util.php
 *   Usage:   write/read configuration file.
 *   Date:    2005-01-31
 *   Auther:  Jun Kuwamura <juk@yokohama.email.ne.jp>
 *   Version: 0.5
 *   History:
 *    2005-02-28 JuK add filepermision setting by myfilemode()
 *    2005-02-01 JuK mod devided from install.php
 */
require_once "fileutil.php";
require_once 'Config.php';
// PEAR Config requires XML_Util and XML_Parser
//install ok: Config 1.10.4
//install ok: XML_Util 1.1.1
//install ok: XML_Parser 1.2.6

function write_config($conf_data)
{
    // Example:
    //   $conf_data = 
    //   array (
    //      'config_file' => './conf/param.xml'
    //      'server_name' => 'localhost',
    //      'root_directory_path' => '/opt/httpd/htdocs/imagelist',
    //      'root_directory_uri' => '/imagelist',
    //      'image_folder' => 'tmp',
    //      'save' => '設定'
    //   );
    //echo "<pre>"; var_export($conf_data); echo "</pre>"; 

    while ( list($k, $v) = each($conf_data) ) {
	$conf_array['SITE_CONFIG'][$k] = $v;
    }

    // 解讀 PHP 陣列
    $c = new Config();
    $content =& $c->parseConfig($conf_array, 'phparray');
    //echo $content->toString('apache')."<br>\n";

    // 以 XML 進行輸出
    $opt = array('version' => '1.0', 'encoding' => 'UTF-8');
    if (!PEAR::isError($write = $c->writeConfig($conf_data['CONFIG_FILE'], 'xml', $opt))) {
	echo 'Done writing configuation file(param.xml).<br>';
    } else {
	echo 'Error writing configuation file(param.xml)!<br>';
	die($write->getMessage());
    }
    chmod($conf_data['CONFIG_FILE'], myfilemode());
    return;
}

$Ver = explode(".",phpversion());
if ($Ver[0] < 4 ) die("PHP version must be greater than 4!<br>");

if ($Ver[0] > 4) {
//
// read_config() SimpleXML 版
//
function read_config($config)
{
    $param=array();
    $init_param = simplexml_load_file( $config );
    //echo $init_param->asXML();
    //var_dump($init_param);
    foreach ( $init_param->children() as $name => $node) {
        //echo $name.' = '.$node."<br/>\n";
        //$init_param->$name;
        $value = ''.$node.'';
	$param[$name] = $value;
    }
    return $param;
}

} else { // php4
/* SAX版 */
function read_config($config)
{
  require_once 'xmlsimple.php';
    $param=array();
    $x = &new MyParser();
    $res = $x->setInputFile($config);   // return stream
    $res = $x->parse();			// return object
    if (XML_Parser::isError($res)) {
	echo "<pre>";var_dump($res);echo "</pre>";
    }
    $eln = $x->getElementNames();
    while ( list($k, $name) = each($eln) ) {
	if ($x->getElementDepthOf( $name ) == 1 ) {
	    $val = $x->getElementOf( $name );
	    // convert from file encoding
	    //$param[$name] = unhtmlentities( $val['data'] );
	    $param[$name] = $val['data'];

	    //echo "$k: ".$name."=".$val['data']."<br>\n";
	    //list($attr, $value) = each( $x->getElementAttribsOf( $name ) );
	    //echo "	(".$attr."=\"".$value."\")<br>\n";
	}
    }
    // set file permision
    $fmode = octdec($param['FILE_MODE']);
    myfilemode($fmode);
    return ($param);
}

function unhtmlentities( $string )
{
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);
    return strtr($string, $trans_tbl);
}
}
?>
