<?php
/*
 * DBA�����͡��ơ������֡��á��������������򡦀�������
 *
 *  Win32�̡ͥ��ߡ������ϡ����̡��ޡ���php.ini ���� extension=php_dba.dll ���������������
 *  DBA��䧥���꣥��������������Ρ��������ͥ��͡���������������
 *
 */
if (!extension_loaded('dba')) {
	if (!dl('dba.so')) {	// dl('php_dba.dll') for Win32 
		error_log( "Error loading dba.so!", 0 );
		exit;
	}
}
//defilne('DBHandler', 'gdbm');
define('DBHandler', 'inifile');

// ��������塣�����ҡ��ȡ������ˡ������򡦀��͡��֡��ơ��顣��
// �������򡦀�������DB���桦������������ĥ������������ϡ��������ߥ��¥硢�����
function countup ($dbafn,$key) {
    if ( empty($_SERVER['SERVER_SOFTWARE']) ) {
	error_log( "countup: not form web", 0 );
	return (false);
    }

    if (! $key ) {
	error_log( "countup: no key specified", 0 );
	return (false);
    }

    // �������򡦀�������DB���桦���������
    if ( file_exists($dbafn) ) {
        // ���
        $dbaid=dba_open($dbafn, "w", DBHandler);
	if (!$dbaid) {
	    error_log( "countup: dba_open not writeable \"$dbafn\"", 0 );
	    return (false);
	}
    } else {
        // ����
        $dbaid=dba_open($dbafn, "c", DBHandler);
	if (!$dbaid) {
	    error_log( "countup: dba_open creation failed \"$dbafn\"", 0 );
	    return (false);
	}
    }

    // ���졣���������ۥʥߥޥ����ۥ̥����͡������򡦀��͡��֡��ơ���
    if ( dba_exists($key,$dbaid) ) {
        $count = dba_fetch($key,$dbaid);
        // �����������ϡץ����ƥ�������
        $n = intval($count) + 1;
        $count = strval($n);
        dba_replace($key,$count,$dbaid);
    } else {
        // ��������ʥߥޥ�
        $count = "1";
        dba_insert($key,$count,$dbaid);
    }
    dba_close($dbaid);

    return ($count);
}


// ��������塣�����ۡ������򡦀��������ƥء�������ߡ���
function getcount ($dbafn,$key) {

    if (! $key ) {
	error_log( "getcount: no key specified", 0 );
        return (false);
    }

    // �������򡦀�������DB���桦���������
    if ( file_exists($dbafn) ) {
        // ���
        $dbaid=dba_open($dbafn, "r", DBHandler);
	if (!$dbaid) {
	    error_log( "getcount: dba_open not readable \"$dbafn\"", 0 );
	    $count = false;
	}
    } else {
        // �ե�
	error_log( "getcount: no dba file \"$dbafn\"", 0 );
	$count = false;
    }

    // ���졣���������ۥʥߥޥ����ۥ̥����͡������򡦀��͡��֡��ơ���
    if ( dba_exists($key,$dbaid) ) {
        $count = dba_fetch($key,$dbaid);
    } else {
	error_log( "getcount: no key found \"$key\" in dba file.", 0 );
	$count = false;
    }
    dba_close($dbaid);

    return ($count);
}

// �������򡦀����������������ͥ��ߥۥ�
function counterlist ($dbafn) {
    if ( file_exists($dbafn) ) {    // �إ�
        $dbaid=dba_open($dbafn, "r", DBHandler);
        //echo "$dbaid<br>";
        if ($dbaid) {
            $key = dba_firstkey($dbaid);
            //echo "key: $key<br>";
            echo "<ul>\n";
            while ($key) {
                echo "<li><a href=\"$key\">$key</a>";
                echo " = ".dba_fetch($key,$dbaid)."\n";
                $key = dba_nextkey($dbaid);
            }
            echo "</ul>\n";
            dba_close($dbaid);
        }
    } else {            // �ե�
	echo "No counter DB($dbafn) exits.<br>\n";
    }
}
?>

<?php
function countlist ($dbafn) {
    if (! file_exists($dbafn) ) {
        error_log( "countlist: no dba file found \"$dbafn\"", 0 );
        return 0;
    }
    $dbaid=dba_open("$dbafn", "r", DBHandler);
    if (! $dbaid) {
        error_log( "countlist: dba file open faild \"$dbafn\"", 0 );
        return 0;
    }
    $key = dba_firstkey($dbaid);
    $counter = array();
    while ($key) {
        $value=dba_fetch($key,$dbaid);
        $counter[$key] = $value;
        $key = dba_nextkey($dbaid);
    }
    dba_close($dbaid);
    return $counter;
}

function countreset ($dbafn, $key, $value) {
    if (! file_exists($dbafn) ) {
        error_log( "countreset: no dba file found \"$dbafn\"", 0 );
        return 0;
    }
    if (! is_writeable($dbafn) ) {
        error_log( "countreset: dba file is not writeable \"$dbafn\"", 0 );
        return 0;
    }
    $dbaid=dba_open("$dbafn", "w", DBHandler);
    if (! $dbaid) {
        error_log( "countreset: dba file open faild \"$dbafn\"", 0 );
        return 0;
    }
    dba_replace($key,$value,$dbaid);
    dba_close($dbaid);
    $counter[$key]=$value;
    return $counter;
}
?>
