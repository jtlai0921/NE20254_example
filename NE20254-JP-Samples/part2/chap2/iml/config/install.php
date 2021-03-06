<?
/*
 *  install
 *  --------------------
 *   File:    install.php
 *   Usage:   installation(configuration) create ./conf/param.xml
 *   Date:    2005-01-31
 *   Auther:  Jun Kuwamura <juk@yokohama.email.ne.jp>
 *   Version: 0.5
 *   History:
 *    2005-02-28 JuK add FILE_MODE for permission for new files
 *    2005-02-20 JuK add admin/password
 *    2005-02-14 JuK mod rename config.php to siteconfig.php
 *    2005-02-01 JuK mod delive config.php
 */
require_once "fileutil.php";
$config_folder = './config';
$config_file = 'param.xml';
$data_folder = './data';
$list_file = "imagelist.txt";
$auth_db = "auth.db";

// ケスタョ・ユ・ゥ・�Д拭���チ・ァ・テ・ッ。「フオ、ア、�Ε潺栢促�
if ( ! check_writable_folder ( $config_folder ) ) {
    // ス��ュケ��゜、ヌ、ュ、ハ、ア、�Ε漾Ε�・鬘シ
    Error( "ケスタョ・ユ・ゥ・�Д拭▲劵���ュケ��犧「クツ、ャ、「、熙゛、サ、��」", __LINE__, __FILE__);
    die ('ケスタョ・ユ・ゥ・�Д� "'.$config_folder.'" 、��ト、ッ、テ、ニWeb・オ。シ・ミ、ォ、鮨��ュケ��゜、ヌ、ュ、��隍ヲ、ヒ、キ、ニ、ッ、タ、オ、、。」');
}

// チエツホケスタョ・ユ・。・、・�Ε曠���ュケ��゜・ム。シ・゜・テ・キ・逾����チ・ァ・テ・ッ
$config_file_path = "$config_folder/$config_file";
if ( file_exists($config_file_path) ) {
    Error( "、ケ、ヌ、ヒケスタョ・ユ・。・、・� \"$config_file_path\" 、ャツクコ゜、キ、゛、ケ。」", __LINE__, __FILE__);
    exit;
    //if (! is_writeable($config_file_path) ) {
    //	Error( "ケスタョ・ユ・。・、・�Ε劵���ュケ��犧「クツ、ャ、「、熙゛、サ、��」", __LINE__, __FILE__);
    //	print('ケスタョ・ユ・。・、・� "'.$config_file_path.'" 、��eb・オ。シ・ミ、ォ、鮨��ュケ��゜、ヌ、ュ、��隍ヲ、ヒ、キ、ニ、ッ、タ、オ、、。」');
    //  exit;
    //}
}

// ・ヌ。シ・ソ・ユ・ゥ・�Д拭���チ・ァ・テ・ッ。「フオ、ア、�Ε潺栢促�
if ( ! check_writable_folder ( $data_folder ) ) {
    // ス��ュケ��゜、ヌ、ュ、ハ、ア、�Ε漾Ε�・鬘シ
    Error( "ケスタョ・ユ・ゥ・�Д拭▲劵���ュケ��犧「クツ、ャ、「、熙゛、サ、��」", __LINE__, __FILE__);
    die ('・ヌ。シ・ソ・ユ・ゥ・�Д� "'.$data_folder.'" 、��ト、ッ、テ、ニWeb・オ。シ・ミ、ォ、鮨��ュケ��゜、ヌ、ュ、��隍ヲ、ヒ、キ、ニ、ッ、タ、オ、、。」');
}

// ・ヌ・ユ・ゥ・�Д優謄�
//echo "<pre>"; var_export($_SERVER); echo "</pre>";
$default_param = array(
	'SITE_TITLE' => '・、・癸シ・ク・�Д院Ε�',
	'SITE_DESCRIPTION' => '・ヘ・テ・ネ・��シ・ッアロ、キ、ヒイ霖��ヌ。シ・ソ、��ノヘ��ケ、�Ε宗≒Ε�Web・、・��ソ。シ・ユ・ァ。シ・ケ、ホ・ラ・�Д諭Ε宗Α◆Ε蕁▲漫▲院�」PHPクタク�Ε辧�隍�Д蕁��А次�鬣゜・��ー、ホシツクウ、����ヘ、ニシツチ����ヤ、ハ、テ、ニ、、、゛、ケ。」',
	'SERVER_NAME' => $_SERVER['HTTP_HOST'],
	'CONFIG_FILE' => $config_folder.'/'.$config_file,
	'ROOT_DIRECTORY_PATH' => dirname($_SERVER['SCRIPT_FILENAME']),
	'ROOT_DIRECTORY_URI' => dirname($_SERVER['PHP_SELF']),
	'DATA_FOLDER' => $data_folder,
	'LIST_FILE' => $data_folder.'/'.$list_file,
	'AUTH_DSN' => "sqlite:///$data_folder/$auth_db",
	'FILE_MODE' => '0646',
	'ADMIN_USER' => 'admin',
	'ADMIN_PASS' => ''
	);

include 'siteconfig.php';
?>
