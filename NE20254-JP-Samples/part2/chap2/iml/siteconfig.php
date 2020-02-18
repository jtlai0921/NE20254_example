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

// ¥Á¥¨¥Ä¥Û¥±¥¹¥¿¥ç¥Ë€€¥Þ¡¦¥æ¡¦¥¥¡£¥·¡¦à(HTML_QuickForm ¡¢€€¥Í¡¢¥ò)
require_once "HTML/QuickForm.php";
$form = new HTML_QuickForm();

// ¥¹ò¶€€¥Ø¡¢¥Û¡¦¥µ¡¦¥Æ¡¦¥Í
$form->setDefaults( $default_param );

// ¡¦¥æ¡¦¥¥¡£¥·¡¦à¦¥Û¥Ø¥é¥Á¥Ì¡¢¥Ò¥È¥Î¥¤¥Æ			 
$form->addElement('text', 'SITE_TITLE', '¡¦¥ª¡¦¡¢¡¦¥Í¡¢¥Û¡¦¥½¡¦¡¢¡¦¥Í¡¦ë');
$form->addElement('text', 'SITE_DESCRIPTION', '¡¦¥ª¡¦¡¢¡¦¥Í¡¢¥Û¥¿äÎ¥¿');
$form->addElement('text', 'SERVER_NAME', '¡¦¥ª¡£¥·¡¦¥ß¥Õ¥»');
$form->addElement('text', 'ROOT_DIRECTORY_PATH', '¡¦ö£¥·¡¦¥Í¡¦¥Ì¡¦¡×¡¦ø§¥Ã¡¦¥Í¡¦ê');
$form->addElement('text', 'ROOT_DIRECTORY_URI', '¡¦ö£¥·¡¦¥Í¡¦¡Ö¡¦¥Ã¡¦¥µ¡¦¥±URI');
$form->addElement('text', 'DATA_FOLDER', '¡¦¥Ì¡£¥·¡¦¥½¡¦¥æ¡¦¥¥¡¦ö§¥¿¥Õ¥»');
$form->addElement('text', 'LIST_FILE', '¡¦ô§¥±¡¦¥Í¡¦¥æ¡¦¡£¡¦¡¢¡¦öÎ¥»');
$form->addElement('text', 'AUTH_DSN', '¥Ì¥¡¥»¥ìDB¡¢¥ÛDSN');
$form->addElement('text', 'FILE_MODE', '¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥Û¡¦¥à¡£¥·¡¦¡¬¡¦¥Æ¡¦¥­¡¦î§ó');
$form->addElement('text', 'ADMIN_USER', '¥¨¥Î¥Ø€€ì£¥·¡¦¥«¥Õ¥»');
$form->addElement('password', 'ADMIN_PASS', '¥¨¥Î¥Ø€€¥à¡¦¥±¡¦þ£¥·¡¦¥Î');
$form->addElement('hidden', 'CONFIG_FILE');
$form->addElement('submit', 'SAVE', '¥¿¡¬¥Èê');

// ¡¦¥©¡¦¥±¡¦¥½¡¦à§ö£¥·¡¦ö¦€€¥ß¥Þ¥½
$form->registerRule('check_data_folder', 'function', 'check_data_folder');
$form->registerRule('check_file_mode', 'function', 'check_file_mode');

// ¥Ë€€¥Þ¥Æ¥Ø¡¢¥Û¥¯¡£¥»¥ì¡¦ö£¥·¡¦ö¦€€¡¬¥Èê
$form->addRule('SITE_TITLE', '¡¦¥ª¡¦¡¢¡¦¥Í¡¢¥Û¡¦¥½¡¦¡¢¡¦¥Í¡¦ö¦€€€€¥Þ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢', 'required');
$form->addRule('SITE_DESCRIPTION', '¡¦¥ª¡¦¡¢¡¦¥Í¡¢¥Û¥¿äÎ¥¿¡¢€€€€¥Þ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢', 'required');
$form->addRule('SERVER_NAME', '¡¦¥ª¡£¥·¡¦¥ß¥Õ¥»¡¢€€€€¥Þ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢', 'required');
$form->addRule('ROOT_DIRECTORY_PATH', '¡¦¥ë¡£¥·¡¦¥±¡¦¥Ì¡¦¡×¡¦ø§¥Ã¡¦¥Í¡¦ô¦¥Û¡¦¥à¡¦¥±¡¢€€€€¥Þ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢', 'required');
$form->addRule('ROOT_DIRECTORY_URI', 'Web¡¦¡Ö¡¦¥Ã¡¦¥µ¡¦¥±¡¢¥Û¡¢¥½¡¢â¦¥Û¡¦¥ë¡£¥·¡¦¥±¡¢¥Í¡¢¥Ï¡¢õ¶RI¡¢€€€€¥Þ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢', 'required');
$form->addRule('DATA_FOLDER', '¡¦¡¢¡¦â£¥·¡¦¥¯¡¦¥æ¡¦¥¥¡¦ö§¥¿¡¢€€¥Ï¥Ì¥·¡¢¥±¡¢ö§¥Ì¡£¥·¡¦¥½¡¦¥æ¡¦¥¥¡¦ö§¥¿¥Õ¥»¡¢€€€€¥Þ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢', 'required');
$form->addRule('DATA_FOLDER', '¥¹€€¥å¥±€€¡¬¥¤¥È¥Ì¥¹¡¢¥Ï¡¦¥æ¡¦¥¥¡¦ö§¥¿¡¢¥Ò¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢', 'check_data_folder', 'w');
$form->addRule('LIST_FILE', '¡¦¡¢¡¦â£¥·¡¦¥¯¡¦¥æ¡¦¥¥¡¦ö§¥¿¡¢¥Û¡¦ô§¥±¡¦¥Í¡¢€€¥ó¥Ä¥¯¡¢¥±¡¢ö§¥æ¡¦¡£¡¦¡¢¡¦öÎ¥»¡¢€€€€¥Þ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢', 'required');
$form->addRule('AUTH_DSN', '¥Ì¥¡¥»¥ì¥Ø¥à¡¦¥Ì¡£¥·¡¦¥½¡¦¥ë¡£¥·¡¦¥±¡¢¥ÛDSN(DataSet Name)¡¢€€€€¥Þ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢', 'required');
$form->addRule('FILE_MODE', '¥¤¥È¥Ì¥¹¡¢¥Ï¡¦ä£¥·¡¦¥Î¡¢¥Þ 0646 ¡¢¡«¡¢¥½¡¢¥Þ 0664 ¡¢¥Ì¡¢¥±', 'check_file_mode', '0666');
$form->addRule('ADMIN_USER', '¡¦¡¢¡¦â£¥·¡¦¥¯¡¦¥æ¡¦¥¥¡¦ö§¥¿¡¢¥Û¥¨¥Î¥Ø€€¥à¡¦ì£¥·¡¦¥«¥Õ¥»¡¢€€€€¥Þ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢', 'required');
$form->addRule('ADMIN_PASS', '¡¦¡¢¡¦â£¥·¡¦¥¯¡¦¥æ¡¦¥¥¡¦ö§¥¿¡¢¥Û¥¨¥Î¥Ø€€¥à¡¦ì£¥·¡¦¥«¡¢¥Û¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢€€€€¥Þ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢', 'required');

if ($form->validate()) {
    $form->process('save_config');
} else {
    $form->display();
}


// form->process ¡¢¥Ò¡¢¥Ë¥Ê¥ß¥Þ¥½¡¢¥±¡¢ö§¥¦¡£¥·¡¦ö§¥ß¡¦¥Æ¡¦¥Ã¥¨¥ê¥½ô
function save_config($form_data) {
    require_once 'config_util.php';

    $user = $form_data['ADMIN_USER'];
    $pass = $form_data['ADMIN_PASS'];
    $form_data['ADMIN_PASS'] = md5($pass);
    $fmode = octdec($form_data['FILE_MODE']);
    myfilemode($fmode);

    require_once 'mydb.php';
    if (! create_usertbl ($form_data['AUTH_DSN'], $user, $pass) ) {
        Error( "¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢¥Û¥¹ò¶€€¥¹¡¢¥Ò¥·¥³¥Ì¥ä¡¢¥­¡¢¡«¡¢¥­¡¢¥½¡£¡×", __LINE__, __FILE__);
        exit;
    }

    write_config($form_data);
    $param = read_config($form_data['CONFIG_FILE']);
    echo "<pre>"; var_export($param); echo "</pre>";
    if ( (is_array($param)?count($param):0) == 0 ) {
        Error( "¡¦¥à¡¦ò§â£¥·¡¦¥½¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥Û¥Ë¥Î¡¢¡¬¥±€€¡¬¡¢¥Ò¥·¥³¥Ì¥ä¡¢¥­¡¢¡«¡¢¥­¡¢¥½¡£¡×", __LINE__, __FILE__);
        exit;
    }

    // ¡¦¥æ¡¦¥¥¡¦ö§¥¿¡¦ô§¥±¡¦¥Í¡¢¥Û¥¹ò¶€€¥¹
    if (! file_exists($param['LIST_FILE']) ) {
	$title	  = ".\t".$param['SITE_TITLE']."\n";
	$abstruct = "+\t".$param['SITE_DESCRIPTION']."\n";
	write_file_lock($param['LIST_FILE'], $title, $abstruct);
	if ( file_exists($param['LIST_FILE']) ) {
	    echo '¡¦¥æ¡¦¥¥¡¦ö§¥¿¡¦ô§¥±¡¦¥Í "'.$param['LIST_FILE'].'" ¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦€€¥È¡¢¥Ã¡¢ô¦¡«¡¢¥­¡¢¥½¡£¡×<br>';
	} else {
	    echo '<font color="red">¡¦¥æ¡¦¥¥¡¦ö§¥¿¡¦ô§¥±¡¦¥Í "'.$param['LIST_FILE'].'¡£¥Î¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥Û¥³üÂ¥ç¡¢¥Ò¥·¥³¥Ì¥ä¡¢¥­¡¢¡«¡¢¥­¡¢¥½¡£¡×</font><br>';
	}
    }

    echo '¡¦¡¢¡¦€€¥±¡¦¥Í¡£¥·¡¦ö¦€€¡¼¥Û¥µ¡¢¥±¡¢ö¦¥Ò¡¢¥Þ¡¼¥Ï¥¤¥·¡¢¥Û¥³ü¸¥Í¡¢€€¥ä¡¢¥Ï¡¢¥Æ¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢:';
    echo '<font color="red"><li>¡¦¥æ¡¦¡£¡¦¡¢¡¦ë "install.php" ¡¢€€¥Æ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢¡£¡×</font></li>';
    echo '<font color="gray"><li>¥¹àÊ€€¥ã¡¢¥Ì¡¢¥å¡¢¥½¡¢ò£¡Ö<a href="imagelist.php">imagelist.php</a>¡¢¥Ò¡¦¡Ö¡¦¥Ã¡¦¥µ¡¦¥±¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢¡£¡×</font></li>';

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
