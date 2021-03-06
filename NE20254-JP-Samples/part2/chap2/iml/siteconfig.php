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

// チエツホケスタョニ��マ・ユ・ゥ。シ・�(HTML_QuickForm 、��ネ、ヲ)
require_once "HTML/QuickForm.php";
$form = new HTML_QuickForm();

// ス魘��ヘ、ホ・サ・テ・ネ
$form->setDefaults( $default_param );

// ・ユ・ゥ。シ・爨ホヘラチヌ、ヒトノイテ			 
$form->addElement('text', 'SITE_TITLE', '・オ・、・ネ、ホ・ソ・、・ネ・�');
$form->addElement('text', 'SITE_DESCRIPTION', '・オ・、・ネ、ホタ篶タ');
$form->addElement('text', 'SERVER_NAME', '・オ。シ・ミフセ');
$form->addElement('text', 'ROOT_DIRECTORY_PATH', '・��シ・ネ・ヌ・」・�Д叩Ε諭��');
$form->addElement('text', 'ROOT_DIRECTORY_URI', '・��シ・ネ・「・ッ・サ・ケURI');
$form->addElement('text', 'DATA_FOLDER', '・ヌ。シ・ソ・ユ・ゥ・�Д織侫�');
$form->addElement('text', 'LIST_FILE', '・�Д院Ε諭Ε罅Α�・、・�離�');
$form->addElement('text', 'AUTH_DSN', 'ヌァセレDB、ホDSN');
$form->addElement('text', 'FILE_MODE', '・ユ・。・、・�Ε曄Ε燹�シ・゜・テ・キ・逾�');
$form->addElement('text', 'ADMIN_USER', 'エノヘ��譯シ・カフセ');
$form->addElement('password', 'ADMIN_PASS', 'エノヘ��ム・ケ・��シ・ノ');
$form->addElement('hidden', 'CONFIG_FILE');
$form->addElement('submit', 'SAVE', 'タ゜ト�');

// ・ォ・ケ・ソ・爭��シ・����ミマソ
$form->registerRule('check_data_folder', 'function', 'check_data_folder');
$form->registerRule('check_file_mode', 'function', 'check_file_mode');

// ニ��マテヘ、ホク。セレ・��シ・����゜ト�
$form->addRule('SITE_TITLE', '・オ・、・ネ、ホ・ソ・、・ネ・������マ、キ、ニ、ッ、タ、オ、、', 'required');
$form->addRule('SITE_DESCRIPTION', '・オ・、・ネ、ホタ篶タ、����マ、キ、ニ、ッ、タ、オ、、', 'required');
$form->addRule('SERVER_NAME', '・オ。シ・ミフセ、����マ、キ、ニ、ッ、タ、オ、、', 'required');
$form->addRule('ROOT_DIRECTORY_PATH', '・ル。シ・ケ・ヌ・」・�Д叩Ε諭�熙ホ・ム・ケ、����マ、キ、ニ、ッ、タ、オ、、', 'required');
$form->addRule('ROOT_DIRECTORY_URI', 'Web・「・ッ・サ・ケ、ホ、ソ、皃ホ・ル。シ・ケ、ネ、ハ、��RI、����マ、キ、ニ、ッ、タ、オ、、', 'required');
$form->addRule('DATA_FOLDER', '・、・癸シ・ク・ユ・ゥ・�Д拭���ハヌシ、ケ、�Д漫�シ・ソ・ユ・ゥ・�Д織侫察�����マ、キ、ニ、ッ、タ、オ、、', 'required');
$form->addRule('DATA_FOLDER', 'ス��ュケ��゜イトヌス、ハ・ユ・ゥ・�Д拭▲辧▲�、ニ、ッ、タ、オ、、', 'check_data_folder', 'w');
$form->addRule('LIST_FILE', '・、・癸シ・ク・ユ・ゥ・�Д拭▲曄��Д院Ε諭���ンツク、ケ、�Д罅Α�・、・�離察�����マ、キ、ニ、ッ、タ、オ、、', 'required');
$form->addRule('AUTH_DSN', 'ヌァセレヘム・ヌ。シ・ソ・ル。シ・ケ、ホDSN(DataSet Name)、����マ、キ、ニ、ッ、タ、オ、、', 'required');
$form->addRule('FILE_MODE', 'イトヌス、ハ・筍シ・ノ、マ 0646 、゛、ソ、マ 0664 、ヌ、ケ', 'check_file_mode', '0666');
$form->addRule('ADMIN_USER', '・、・癸シ・ク・ユ・ゥ・�Д拭▲曠┘離���ム・譯シ・カフセ、����マ、キ、ニ、ッ、タ、オ、、', 'required');
$form->addRule('ADMIN_PASS', '・、・癸シ・ク・ユ・ゥ・�Д拭▲曠┘離���ム・譯シ・カ、ホ・ム・ケ・��シ・ノ、����マ、キ、ニ、ッ、タ、オ、、', 'required');

if ($form->validate()) {
    $form->process('save_config');
} else {
    $form->display();
}


// form->process 、ヒ、ニナミマソ、ケ、�ДΑ�シ・�Д漾Ε董Ε奪┘螢諸
function save_config($form_data) {
    require_once 'config_util.php';

    $user = $form_data['ADMIN_USER'];
    $pass = $form_data['ADMIN_PASS'];
    $form_data['ADMIN_PASS'] = md5($pass);
    $fmode = octdec($form_data['FILE_MODE']);
    myfilemode($fmode);

    require_once 'mydb.php';
    if (! create_usertbl ($form_data['AUTH_DSN'], $user, $pass) ) {
        Error( "・ム・ケ・��シ・ノ、ホス魘��ス、ヒシコヌヤ、キ、゛、キ、ソ。」", __LINE__, __FILE__);
        exit;
    }

    write_config($form_data);
    $param = read_config($form_data['CONFIG_FILE']);
    echo "<pre>"; var_export($param); echo "</pre>";
    if ( (is_array($param)?count($param):0) == 0 ) {
        Error( "・ム・鬣癸シ・ソ・ユ・。・、・�Ε曠縫痢◆�ケ��゜、ヒシコヌヤ、キ、゛、キ、ソ。」", __LINE__, __FILE__);
        exit;
    }

    // ・ユ・ゥ・�Д拭��Д院Ε諭▲曠穀���ス
    if (! file_exists($param['LIST_FILE']) ) {
	$title	  = ".\t".$param['SITE_TITLE']."\n";
	$abstruct = "+\t".$param['SITE_DESCRIPTION']."\n";
	write_file_lock($param['LIST_FILE'], $title, $abstruct);
	if ( file_exists($param['LIST_FILE']) ) {
	    echo '・ユ・ゥ・�Д拭��Д院Ε� "'.$param['LIST_FILE'].'" ・ユ・。・、・����ト、ッ、熙゛、キ、ソ。」<br>';
	} else {
	    echo '<font color="red">・ユ・ゥ・�Д拭��Д院Ε� "'.$param['LIST_FILE'].'。ノ・ユ・。・、・�Ε曠栢促隋▲劵轡灰魅筺▲�、゛、キ、ソ。」</font><br>';
	}
    }

    echo '・、・��ケ・ネ。シ・����ーホサ、ケ、�Ε辧▲沺璽魯ぅ掘▲曠栢献諭���ヤ、ハ、テ、ニ、ッ、タ、オ、、:';
    echo '<font color="red"><li>・ユ・。・、・� "install.php" 、��テ、キ、ニ、ッ、タ、オ、、。」</font></li>';
    echo '<font color="gray"><li>ス猜��ャ、ヌ、ュ、ソ、鬘「<a href="imagelist.php">imagelist.php</a>、ヒ・「・ッ・サ・ケ、キ、ニ、ッ、タ、オ、、。」</font></li>';

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
