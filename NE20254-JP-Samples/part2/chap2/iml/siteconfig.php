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

// �����ĥۥ�������ˀ��ޡ��桦���������(HTML_QuickForm �����͡���)
require_once "HTML/QuickForm.php";
$form = new HTML_QuickForm();

// ��򶀀�ء��ۡ������ơ���
$form->setDefaults( $default_param );

// ���桦��������থۥإ���̡��ҥȥΥ���			 
$form->addElement('text', 'SITE_TITLE', '�����������͡��ۡ����������͡��');
$form->addElement('text', 'SITE_DESCRIPTION', '�����������͡��ۥ��Υ�');
$form->addElement('text', 'SERVER_NAME', '�����������ߥե�');
$form->addElement('text', 'ROOT_DIRECTORY_PATH', '���������͡��̡��ס����á��͡��');
$form->addElement('text', 'ROOT_DIRECTORY_URI', '���������͡��֡��á�������URI');
$form->addElement('text', 'DATA_FOLDER', '���̡����������桦���������ե�');
$form->addElement('text', 'LIST_FILE', '���������͡��桦���������Υ�');
$form->addElement('text', 'AUTH_DSN', '�̥�����DB����DSN');
$form->addElement('text', 'FILE_MODE', '���桦�����������ۡ��ࡣ���������ơ�������');
$form->addElement('text', 'ADMIN_USER', '���Υ؀�죥������ե�');
$form->addElement('password', 'ADMIN_PASS', '���Υ؀��ࡦ������������');
$form->addElement('hidden', 'CONFIG_FILE');
$form->addElement('submit', 'SAVE', '�������');

// ��������������������������ߥޥ�
$form->registerRule('check_data_folder', 'function', 'check_data_folder');
$form->registerRule('check_file_mode', 'function', 'check_file_mode');

// �ˀ��ޥƥء��ۥ������졦���������������
$form->addRule('SITE_TITLE', '�����������͡��ۡ����������͡��������ޡ������ˡ��á�����������', 'required');
$form->addRule('SITE_DESCRIPTION', '�����������͡��ۥ��Υ��������ޡ������ˡ��á�����������', 'required');
$form->addRule('SERVER_NAME', '�����������ߥե��������ޡ������ˡ��á�����������', 'required');
$form->addRule('ROOT_DIRECTORY_PATH', '���롣���������̡��ס����á��͡����ۡ��ࡦ���������ޡ������ˡ��á�����������', 'required');
$form->addRule('ROOT_DIRECTORY_URI', 'Web���֡��á����������ۡ�����⦥ۡ��롣���������͡��ϡ���RI�������ޡ������ˡ��á�����������', 'required');
$form->addRule('DATA_FOLDER', '������⣥��������桦�������������ϥ̥����������̡����������桦���������ե��������ޡ������ˡ��á�����������', 'required');
$form->addRule('DATA_FOLDER', '�����奱�������ȥ̥����ϡ��桦�����������ҡ������ˡ��á�����������', 'check_data_folder', 'w');
$form->addRule('LIST_FILE', '������⣥��������桦�����������ۡ��������͡�����ĥ����������桦���������Υ��������ޡ������ˡ��á�����������', 'required');
$form->addRule('AUTH_DSN', '�̥�����إࡦ�̡����������롣����������DSN(DataSet Name)�������ޡ������ˡ��á�����������', 'required');
$form->addRule('FILE_MODE', '���ȥ̥����ϡ�䣥����Ρ��� 0646 ������������ 0664 ���̡���', 'check_file_mode', '0666');
$form->addRule('ADMIN_USER', '������⣥��������桦�����������ۥ��Υ؀��ࡦ죥������ե��������ޡ������ˡ��á�����������', 'required');
$form->addRule('ADMIN_PASS', '������⣥��������桦�����������ۥ��Υ؀��ࡦ죥��������ۡ��ࡦ�����������Ρ������ޡ������ˡ��á�����������', 'required');

if ($form->validate()) {
    $form->process('save_config');
} else {
    $form->display();
}


// form->process ���ҡ��˥ʥߥޥ��������������������ߡ��ơ��å��꥽�
function save_config($form_data) {
    require_once 'config_util.php';

    $user = $form_data['ADMIN_USER'];
    $pass = $form_data['ADMIN_PASS'];
    $form_data['ADMIN_PASS'] = md5($pass);
    $fmode = octdec($form_data['FILE_MODE']);
    myfilemode($fmode);

    require_once 'mydb.php';
    if (! create_usertbl ($form_data['AUTH_DSN'], $user, $pass) ) {
        Error( "���ࡦ�����������Ρ��ۥ�򶀀�����ҥ����̥䡢������������������", __LINE__, __FILE__);
        exit;
    }

    write_config($form_data);
    $param = read_config($form_data['CONFIG_FILE']);
    echo "<pre>"; var_export($param); echo "</pre>";
    if ( (is_array($param)?count($param):0) == 0 ) {
        Error( "���ࡦ�⣥��������桦�����������ۥ˥Ρ������������ҥ����̥䡢������������������", __LINE__, __FILE__);
        exit;
    }

    // ���桦�����������������͡��ۥ�򶀀��
    if (! file_exists($param['LIST_FILE']) ) {
	$title	  = ".\t".$param['SITE_TITLE']."\n";
	$abstruct = "+\t".$param['SITE_DESCRIPTION']."\n";
	write_file_lock($param['LIST_FILE'], $title, $abstruct);
	if ( file_exists($param['LIST_FILE']) ) {
	    echo '���桦������������������ "'.$param['LIST_FILE'].'" ���桦�������������ȡ��á�����������������<br>';
	} else {
	    echo '<font color="red">���桦������������������ "'.$param['LIST_FILE'].'���Ρ��桦�����������ۥ��¥硢�ҥ����̥䡢������������������</font><br>';
	}
    }

    echo '�������������͡������������ۥ����������ҡ��ޡ��ϥ������ۥ����͡����䡢�ϡ��ơ��ˡ��á�����������:';
    echo '<font color="red"><li>���桦��������� "install.php" �����ơ������ˡ��á���������������</font></li>';
    echo '<font color="gray"><li>���ʀ��㡢�̡��塢������<a href="imagelist.php">imagelist.php</a>���ҡ��֡��á��������������ˡ��á���������������</font></li>';

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
