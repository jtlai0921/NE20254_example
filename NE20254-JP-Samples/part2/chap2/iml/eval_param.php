<?php
// ���桦�������á�������̡��ޡ��򡢡����á�즥����ϡ���������⧡������á��������Ρ������˥��͡����򡢥ҡ�����������
//function evalparam( $param_template, $param_path )
//{
    // $param_template ���桦�����������ۥ��ϥˡ��������ߡ��ơ���(eval���꥽�����͡��ơ���)����
    // �������ۥ����ա�� $param_path ���桦�����������ҥ����她�ߡ�������
    $timestamp=date("D M j G:i:s T Y");
    $param_cont = join ('', file($param_template));
    //echo $param_cont;
    // ���������������͡��塢�ޥϥ������ҡ��������桢�������� '"' ��� '%' ���ޥ��͡������ϡ��� ����
    //$ret = eval("echo \"$param_cont\";");
    $ret = eval("\$param_set = sprintf(\"$param_cont\");");
    if ( is_writeable("$param_path") || (! file_exists($param_path) && is_writeable(dirname($param_path)) ) ) {
	  $fp = fopen("$param_path", "w");
	  $ret = eval("fwrite(\$fp, \$param_set);");
	  fclose($fp);
    } else {
	  echo "<font color='red'>parameter file($param_path) is not writeable.</font><br />";
    }
//}
?>
