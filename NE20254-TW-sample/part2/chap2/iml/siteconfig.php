<?php
/*
 *  siteconfig
 *  --------------------
 *   File:    siteconfig.php
 *   Usage:   configuration form.
 *   Date:    2005-01-31
 *   Auther:  Jun Kuwamura <juk@yokohama.email.ne.jp>
 *   Version: 0.5
 *   History:
 *    2005-02-28 JuK add filepermision setting by myfilemode()
 *    2005-02-28 JuK add FILE_MODE for permission for new files
 *    2005-02-20 JuK add admin/password
 *    2005-02-01 JuK mod devided from install.php
 */

// 輸入表單整體架構 (使用 HTML_QuickForm)
require_once "HTML/QuickForm.php";
$form = new HTML_QuickForm();

header('Content-Type: text/html; charset=utf-8');

// 設定初始值
$form->setDefaults( $default_param );

// 新增表單元素
$form->addElement('text', 'SITE_TITLE', '網站標題');
$form->addElement('text', 'SITE_DESCRIPTION', '網站說明');
$form->addElement('text', 'SERVER_NAME', '伺服器名稱');
$form->addElement('text', 'ROOT_DIRECTORY_PATH', '根目錄路徑');
$form->addElement('text', 'ROOT_DIRECTORY_URI', '根目錄 URI');
$form->addElement('text', 'DATA_FOLDER', '資料目錄名');
$form->addElement('text', 'LIST_FILE', '清單檔名');
$form->addElement('text', 'AUTH_DSN', '認證用 DB 的 DSN');
$form->addElement('text', 'FILE_MODE', '檔案權限模式');
$form->addElement('text', 'ADMIN_USER', '管理者名');
$form->addElement('password', 'ADMIN_PASS', '管理者密碼');
$form->addElement('hidden', 'CONFIG_FILE');
$form->addElement('submit', 'SAVE', '儲存設定');

// 登錄自訂規則
$form->registerRule('check_data_folder', 'function', 'check_data_folder');
$form->registerRule('check_file_mode', 'function', 'check_file_mode');

// 設定輸入值的驗證規則
$form->addRule('SITE_TITLE', '請輸入網站標題', 'required');
$form->addRule('SITE_DESCRIPTION', '請輸入網站說明', 'required');
$form->addRule('SERVER_NAME', '請輸入伺服器名稱', 'required');
$form->addRule('ROOT_DIRECTORY_PATH', '請輸入根目錄路徑', 'required');
$form->addRule('ROOT_DIRECTORY_URI', '請輸入 Web 存取根目錄所用的 URI', 'required');
$form->addRule('DATA_FOLDER', '請輸入儲存圖片目錄的資料目錄路徑', 'required');
$form->addRule('DATA_FOLDER', '請將資料目錄改為可供寫入', 'check_data_folder', 'w');
$form->addRule('LIST_FILE', '請輸入儲存圖片目錄清單的檔名', 'required');
$form->addRule('AUTH_DSN', '請輸入認證用資料庫的 DSN (DataSet Name)', 'required');
$form->addRule('FILE_MODE', '可用的模式僅有 0646 與 0664', 'check_file_mode', '0666');
$form->addRule('ADMIN_USER', '請輸入管理圖片目錄的管理者名', 'required');
$form->addRule('ADMIN_PASS', '請輸入管理圖片目錄的管理者密碼', 'required');

if ($form->validate()) {
    $form->process('save_config');
} else {
    $form->display();
}


// form->process 登錄的回呼函式
function save_config($form_data) {
    require_once 'config_util.php';

    $user = $form_data['ADMIN_USER'];
    $pass = $form_data['ADMIN_PASS'];
    $form_data['ADMIN_PASS'] = md5($pass);
    $fmode = octdec($form_data['FILE_MODE']);
    myfilemode($fmode);

    require_once 'mydb.php';
    if (! create_usertbl ($form_data['AUTH_DSN'], $user, $pass) ) {
        Error( "密碼設定失敗。", __LINE__, __FILE__);
        exit;
    }

    write_config($form_data);
    $param = read_config($form_data['CONFIG_FILE']);
    echo "<pre>"; var_export($param); echo "</pre>";
    if ( (is_array($param)?count($param):0) == 0 ) {
        Error( "無法讀入設定檔。", __LINE__, __FILE__);
        exit;
    }

    // 初始化目錄清單
    if (! file_exists($param['LIST_FILE']) ) {
	$title	  = ".\t".$param['SITE_TITLE']."\n";
	$abstruct = "+\t".$param['SITE_DESCRIPTION']."\n";
	//write_file_lock($param['LIST_FILE'], $title, $abstruct);
        require_once "filetable.php";
        $ft = new FileTable( $param['LIST_FILE'] );
        if ( $ft->addrow($title) === false ) {
          Error("無法將標題存入圖片清單檔(". $ft->geterr(). ")。", __LINE__, __FILE__);
        }
        if ( $ft->addrow($abstruct) === false ) {
          Error("無法將說明存入圖片清單檔(". $ft->geterr(). ")。", __LINE__, __FILE__);
        }
        
	if ( file_exists($param['LIST_FILE']) ) {
	    echo '已成功建立目錄清單檔 "'.$param['LIST_FILE'].'"。<br>';
	} else {
	    echo '<font color="red">目錄清單檔 "'.$param['LIST_FILE'].'" 建立失敗。</font><br>';
	}
    }

    echo '安裝完成之後請執行下列步驟:';
    echo '<font color="red"><li>刪除 "install.php" 檔。</font></li>';
    echo '<font color="gray"><li>準備好之後前往<a href="imagelist.php">imagelist.php</a>。</font></li>';

}

function check_data_folder ($param_name, $param_value, $dummy)
{
    if ( file_exists($param_value) ) {
	if ( is_dir($param_value) && is_writeable($param_value) ) {
	    return true;
	} else {
	    return false;
	}
    } else {
	return false;
    }
}

function check_file_mode ($param_name, $param_value, $dummy)
{
    if ( trim($param_value) == '0646' || trim($param_value) == '0664' ) {
	    return true;
	} else {
	    return false;
	}
}

?>
