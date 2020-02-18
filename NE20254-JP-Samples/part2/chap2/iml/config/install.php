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

// ¥±¥¹¥¿¥ç¡¦¥æ¡¦¥¥¡¦ö§¥¿¡¢€€¥Á¡¦¥¡¡¦¥Æ¡¦¥Ã¡£¡Ö¥Õ¥ª¡¢¥¢¡¢ø¦¥ß¥³üÂ¥ç
if ( ! check_writable_folder ( $config_folder ) ) {
    // ¥¹€€¥å¥±€€¡¬¡¢¥Ì¡¢¥å¡¢¥Ï¡¢¥¢¡¢ø¦¥ß¡¦¥£¡¦ò£¥·
    Error( "¥±¥¹¥¿¥ç¡¦¥æ¡¦¥¥¡¦ö§¥¿¡¢¥Ò¥¹€€¥å¥±€€àº¡Ö¥¯¥Ä¡¢¥ã¡¢¡Ö¡¢ô¦¡«¡¢¥µ¡¢€€¡×", __LINE__, __FILE__);
    die ('¥±¥¹¥¿¥ç¡¦¥æ¡¦¥¥¡¦ö§¥¿ "'.$config_folder.'" ¡¢€€¥È¡¢¥Ã¡¢¥Æ¡¢¥ËWeb¡¦¥ª¡£¥·¡¦¥ß¡¢¥©¡¢ò¿€€¥å¥±€€¡¬¡¢¥Ì¡¢¥å¡¢ö¦ð¦¥ò¡¢¥Ò¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢¡£¡×');
}

// ¥Á¥¨¥Ä¥Û¥±¥¹¥¿¥ç¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥Û¥¹€€¥å¥±€€¡¬¡¦¥à¡£¥·¡¦¡¬¡¦¥Æ¡¦¥­¡¦î§€€€€¥Á¡¦¥¡¡¦¥Æ¡¦¥Ã
$config_file_path = "$config_folder/$config_file";
if ( file_exists($config_file_path) ) {
    Error( "¡¢¥±¡¢¥Ì¡¢¥Ò¥±¥¹¥¿¥ç¡¦¥æ¡¦¡£¡¦¡¢¡¦ë \"$config_file_path\" ¡¢¥ã¥Ä¥¯¥³¡¬¡¢¥­¡¢¡«¡¢¥±¡£¡×", __LINE__, __FILE__);
    exit;
    //if (! is_writeable($config_file_path) ) {
    //	Error( "¥±¥¹¥¿¥ç¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥Ò¥¹€€¥å¥±€€àº¡Ö¥¯¥Ä¡¢¥ã¡¢¡Ö¡¢ô¦¡«¡¢¥µ¡¢€€¡×", __LINE__, __FILE__);
    //	print('¥±¥¹¥¿¥ç¡¦¥æ¡¦¡£¡¦¡¢¡¦ë "'.$config_file_path.'" ¡¢€€eb¡¦¥ª¡£¥·¡¦¥ß¡¢¥©¡¢ò¿€€¥å¥±€€¡¬¡¢¥Ì¡¢¥å¡¢ö¦ð¦¥ò¡¢¥Ò¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢¡£¡×');
    //  exit;
    //}
}

// ¡¦¥Ì¡£¥·¡¦¥½¡¦¥æ¡¦¥¥¡¦ö§¥¿¡¢€€¥Á¡¦¥¡¡¦¥Æ¡¦¥Ã¡£¡Ö¥Õ¥ª¡¢¥¢¡¢ø¦¥ß¥³üÂ¥ç
if ( ! check_writable_folder ( $data_folder ) ) {
    // ¥¹€€¥å¥±€€¡¬¡¢¥Ì¡¢¥å¡¢¥Ï¡¢¥¢¡¢ø¦¥ß¡¦¥£¡¦ò£¥·
    Error( "¥±¥¹¥¿¥ç¡¦¥æ¡¦¥¥¡¦ö§¥¿¡¢¥Ò¥¹€€¥å¥±€€àº¡Ö¥¯¥Ä¡¢¥ã¡¢¡Ö¡¢ô¦¡«¡¢¥µ¡¢€€¡×", __LINE__, __FILE__);
    die ('¡¦¥Ì¡£¥·¡¦¥½¡¦¥æ¡¦¥¥¡¦ö§¥¿ "'.$data_folder.'" ¡¢€€¥È¡¢¥Ã¡¢¥Æ¡¢¥ËWeb¡¦¥ª¡£¥·¡¦¥ß¡¢¥©¡¢ò¿€€¥å¥±€€¡¬¡¢¥Ì¡¢¥å¡¢ö¦ð¦¥ò¡¢¥Ò¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢¡£¡×');
}

// ¡¦¥Ì¡¦¥æ¡¦¥¥¡¦ö§¥Í¥Æ¥Ø
//echo "<pre>"; var_export($_SERVER); echo "</pre>";
$default_param = array(
	'SITE_TITLE' => '¡¦¡¢¡¦â£¥·¡¦¥¯¡¦ô§¥±¡¦¥Í',
	'SITE_DESCRIPTION' => '¡¦¥Ø¡¦¥Æ¡¦¥Í¡¦þ£¥·¡¦¥Ã¥¢¥í¡¢¥­¡¢¥Ò¥¤ðÃ€€¥Ì¡£¥·¡¦¥½¡¢€€¥Î¥Ø€€¥±¡¢ö¦¥½¡¢â¦¥ÛWeb¡¦¡¢¡¦€€¥½¡£¥·¡¦¥æ¡¦¥¡¡£¥·¡¦¥±¡¢¥Û¡¦¥é¡¦ú§¥Í¡¦¥½¡¦¡¢¡¦¥é¡¢¥Ì¡¢¥±¡£¡×PHP¥¯¥¿¥¯ø¦¥Ò¡¢ð¦ö§¥é¡¦ú§¡¼¡¦ò§¡¬¡¦€€¡¼¡¢¥Û¥·¥Ä¥¯¥¦¡¢€€€€¥Ø¡¢¥Ë¥·¥Ä¥Á€€€€¥ä¡¢¥Ï¡¢¥Æ¡¢¥Ë¡¢¡¢¡¢¡«¡¢¥±¡£¡×',
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
