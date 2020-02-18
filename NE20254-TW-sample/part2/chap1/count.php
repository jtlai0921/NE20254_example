<?php
/*
 * 結合 DBA 的存取計數器
 *
 *  Win32 版的 PHP 必須在 php.ini 指定 extension=php_dba.dll
 *  載入 DBA 模組之後即可使用
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

// 遞增指定鍵值的計數
// 計數器 DB 檔不存在時建立
function countup ($dbafn,$key) {
    if ( empty($_SERVER['SERVER_SOFTWARE']) ) {
	error_log( "countup: not form web", 0 );
	return (false);
    }

    if (! $key ) {
	error_log( "countup: no key specified", 0 );
	return (false);
    }

    // 計數器 DB 檔
    if ( file_exists($dbafn) ) {
        // 既有
        $dbaid=dba_open($dbafn, "w", DBHandler);
	if (!$dbaid) {
	    error_log( "countup: dba_open not writeable \"$dbafn\"", 0 );
	    return (false);
	}
    } else {
        // 新
        $dbaid=dba_open($dbafn, "c", DBHandler);
	if (!$dbaid) {
	    error_log( "countup: dba_open creation failed \"$dbafn\"", 0 );
	    return (false);
	}
    }

    // 網頁登錄確認及遞增計數
    if ( dba_exists($key,$dbaid) ) {
        $count = dba_fetch($key,$dbaid);
        // 更新 (加 1 )
        $n = intval($count) + 1;
        $count = strval($n);
        dba_replace($key,$count,$dbaid);
    } else {
        // 登錄新頁面
        $count = "1";
        dba_insert($key,$count,$dbaid);
    }
    dba_close($dbaid);

    return ($count);
}


// 提取指定鍵值的計數器值
function getcount ($dbafn,$key) {

    if (! $key ) {
	error_log( "getcount: no key specified", 0 );
        return (false);
    }

    // 計數器 DB 檔
    if ( file_exists($dbafn) ) {
        // 既
        $dbaid=dba_open($dbafn, "r", DBHandler);
	if (!$dbaid) {
	    error_log( "getcount: dba_open not readable \"$dbafn\"", 0 );
	    $count = false;
	}
    } else {
        // 無
	error_log( "getcount: no dba file \"$dbafn\"", 0 );
	$count = false;
    }

    // 網頁登錄確認及遞增計數
    if ( dba_exists($key,$dbaid) ) {
        $count = dba_fetch($key,$dbaid);
    } else {
	error_log( "getcount: no key found \"$key\" in dba file.", 0 );
	$count = false;
    }
    dba_close($dbaid);

    return ($count);
}

// 列出計數器清單
function counterlist ($dbafn) {
    if ( file_exists($dbafn) ) {    // 有
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
    } else {            // 無
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
