<?php
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

// 確認有無設定檔目錄，如果沒有的話就建立
if ( ! check_writable_folder ( $config_folder ) ) {
    // 如果不能寫入的話代表出現錯誤
    Error( "沒有寫入設定檔目錄的權限。", __LINE__, __FILE__);
    die ('請將設定檔目錄 "'.$config_folder.'" 設定成 Web 伺服器可以寫入的狀態。');
}

// 檢查整體設定檔的寫入權限
$config_file_path = "$config_folder/$config_file";
if ( file_exists($config_file_path) ) {
    Error( "已有設定檔 \"$config_file_path\"。", __LINE__, __FILE__);
    exit;
}

// 確認有無資料目錄，如果沒有的話就建立
if ( ! check_writable_folder ( $data_folder ) ) {
    // 如果不能寫入的話代表出現錯誤
    Error( "沒有寫入組態資料夾的權限。", __LINE__, __FILE__);
    die ('請將資料目錄 "'.$data_folder.'" 設定成 Web 伺服器可以寫入的狀態。');
}

// 預設值
//echo "<pre>"; var_export($_SERVER); echo "</pre>";
$default_param = array(
	'SITE_TITLE' => '圖片清單',
	'SITE_DESCRIPTION' => '透過網路管理圖片資料的 Web 介面雛型。使用 PHP 語言實驗、實作。',
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
