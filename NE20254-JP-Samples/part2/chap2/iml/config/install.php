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

// �������硦�桦���������������������ơ��á��֥ե����������ߥ��¥�
if ( ! check_writable_folder ( $config_folder ) ) {
    // �����奱�������̡��塢�ϡ��������ߡ�����򣥷
    Error( "�������硦�桦�����������ҥ����奱��ມ֥��ġ��㡢�֡���������������", __LINE__, __FILE__);
    die ('�������硦�桦�������� "'.$config_folder.'" �����ȡ��á��ơ���Web�����������ߡ�����򿀀�奱�������̡��塢���򡢥ҡ������ˡ��á���������������');
}

// �����ĥۥ������硦�桦�����������ۥ����奱�������ࡣ���������ơ�����������������ơ���
$config_file_path = "$config_folder/$config_file";
if ( file_exists($config_file_path) ) {
    Error( "�������̡��ҥ������硦�桦��������� \"$config_file_path\" ����ĥ���������������������", __LINE__, __FILE__);
    exit;
    //if (! is_writeable($config_file_path) ) {
    //	Error( "�������硦�桦�����������ҥ����奱��ມ֥��ġ��㡢�֡���������������", __LINE__, __FILE__);
    //	print('�������硦�桦��������� "'.$config_file_path.'" ����eb�����������ߡ�����򿀀�奱�������̡��塢���򡢥ҡ������ˡ��á���������������');
    //  exit;
    //}
}

// ���̡����������桦���������������������ơ��á��֥ե����������ߥ��¥�
if ( ! check_writable_folder ( $data_folder ) ) {
    // �����奱�������̡��塢�ϡ��������ߡ�����򣥷
    Error( "�������硦�桦�����������ҥ����奱��ມ֥��ġ��㡢�֡���������������", __LINE__, __FILE__);
    die ('���̡����������桦�������� "'.$data_folder.'" �����ȡ��á��ơ���Web�����������ߡ�����򿀀�奱�������̡��塢���򡢥ҡ������ˡ��á���������������');
}

// ���̡��桦�������ͥƥ�
//echo "<pre>"; var_export($_SERVER); echo "</pre>";
$default_param = array(
	'SITE_TITLE' => '������⣥���������������',
	'SITE_DESCRIPTION' => '���ء��ơ��͡��������å��������ҥ��À��̡������������Υ؀�����������⦥�Web�����������������桦�������������ۡ��顦���͡����������顢�̡�������PHP���������ҡ�����顦������򧡬���������ۥ��ĥ����������ء��˥��ĥ������䡢�ϡ��ơ��ˡ���������������',
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
