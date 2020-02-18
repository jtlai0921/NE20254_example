<?php
//   File Check Utilities and the Other Functions
//
// Jun Kuwamura <juk@yokohama.email.ne.jp>
//	Sun Sep 15 23:02:49 JST 2002
//
// 2005-02-28 JuK add filepermision setting, myfilemode()
// 2002-10-21 JuK text_to_field and name_to_field
// 2002-09-15 JuK Seperated from imagetool.php
//

///////////////////////////////////////
// Debug write function
///////////////////////////////////////
function pre_var_dump( $strings, $level=1, $file='', $line=0 ) {
  global $TEST;
  if ($level < $TEST) {
    echo "<pre><font size='-1'>";
    if (! empty($file) ) {
      echo "$file";
    }
    if ($line) {
      echo "($line)";
    }
    var_dump($strings);
    echo "</pre></font><br>\n";
  }
}

///////////////////////////////////////
// Debug write function
///////////////////////////////////////
function Debug( $strings, $level, $line=0 ) {
  global $TEST;
  if ($level < $TEST) {
    echo "<br><font color=green>debug";
    if ($line) {
      echo "($line)";
    }
    echo ": $strings</font><br>\n";
  }
}

///////////////////////////////////////
// Error output function
///////////////////////////////////////
function Error( $strings, $line=0, $file="" ) {
  echo "<font color='red' size='-1'><br>";
  echo "Error";
  if (! empty($file) ) {
    echo "@$file";
  }
  if ($line) {
    echo "($line)";
  }
  echo ": $strings<br></font>\n";
}

///////////////////////////////////////
// file permittion
///////////////////////////////////////
function myfilemode ( $mode = 00 ) {
  static $filemode = 0666;
  if ( $mode != 00 ) {
      $filemode = $mode;
  }
  return $filemode;
}

///////////////////////////////////////////////////////////////////////
// extract base folder name
//  $folder: folder path
///////////////////////////////////////////////////////////////////////
function basefoldername ( $folder )
{
    return trim(basename($folder)," \t.");
}

///////////////////////////////////////////////////////////////////////
// quote meta characters and add slashes for string to eval
//  $label: string to be quoted
///////////////////////////////////////////////////////////////////////
function addevalslashes ( $label )
{
    return trim(addcslashes(addslashes($label), ';.+-*/?[^]($)'));
}

///////////////////////////////////////////////////////////////////////
// Convert text to fit CSV field
//	Eliminate CR and LF
//	Quote comma character to "%2C"
//	(see ascii table at http://www.asciitable.com/)
//	$str: strings to quote
///////////////////////////////////////////////////////////////////////
function text_to_field ($str) {
    $str = ereg_replace("[\r\n]", "", trim($str));
    $trans = array ("," => "%2C");
    return strtr($str, $trans);
}

///////////////////////////////////////////////////////////////////////
// Check and Convert the personal name strings in DICOM convention.
//	$name: priginal name strings
///////////////////////////////////////////////////////////////////////
function name_to_field ($name) {
    $entry="";
    $tok = strtok( text_to_field($name), " ");
    $enc0 = mb_detect_encoding ( $tok );
    while($tok) {
	$entry .= $tok;
	$tok = strtok(" ");
	if (! $tok === false ) {
	    $enc1 = mb_detect_encoding ( $tok );
	    if ($enc0 == $enc1) {
		$entry .= "^";
	    } else {
		$entry .= "=";
	    }
	    $enc0 = $enc1;
	}
    }
    return $entry;
}

///////////////////////////////////////////////////////////////////////
// Check a directory  be readable or not.
//	$folder: directory path name
//	$lmax: maximum number of chareacters for the path name
// if readable, return the path name.
///////////////////////////////////////////////////////////////////////
function check_readable_folder ( $folder, $lmax=255 ) {
    $code = mb_detect_encoding($folder, "auto");
    if ( $code != "EUC-JP" && $code != "ASCII" ) {
	$folder = mb_convert_encoding( $folder, "EUC-JP" );
    }
    $f_dir=substr(str_replace("\\\\", "/", escapeshellcmd($folder)), 0, $lmax);
    if (! is_dir($f_dir) ) {
	if ( file_exists($f_dir) ) {
	    Error("The folder is not a directory: \"".$f_dir."\"", __LINE__, __FILE__);
	} else {
	    mkdir ($f_dir, 0550);
	    if (! is_dir($f_dir) ) {
	        Error("The folder could not be created: \"".$f_dir."\"", __LINE__, __FILE__);
	    }
	}
	return 0;
    } else {
	if (! is_readable($f_dir) ) {
	    Error("The folder is not readable: \"".$f_dir."\"", __LINE__, __FILE__);
	    return 0;
	}
    }
    return $f_dir;
}    

///////////////////////////////////////////////////////////////////////
// Check a directory  be writable or not.
//	$folder: directory path name
//	$lmax: maximum number of chareacters for the path name
// if writable, return the path name.
///////////////////////////////////////////////////////////////////////
function check_writable_folder ( $folder, $lmax=255 ) {
    $code = mb_detect_encoding($folder, "auto");
    if ( $code != "EUC-JP" && $code != "ASCII" ) {
	$folder = mb_convert_encoding( $folder, "EUC-JP" );
    }
    $f_dir=substr(str_replace("\\\\", "/", escapeshellcmd($folder)), 0, $lmax);
    if (! is_dir($f_dir) ) {
	if ( file_exists($f_dir) ) {
	    Error("The folder is not a directory: \"".$f_dir."\"", __LINE__, __FILE__);
	} else {
	    mkdir ($f_dir, 0770);
	    if (! is_dir($f_dir) ) {
	        Error("The folder could not be created: \"".$f_dir."\"", __LINE__, __FILE__);
	    }
	}
	return 0;
    } else {
	if (! is_writeable($f_dir) ) {
	    Error("The folder is not writable: \"".$f_dir."\"", __LINE__, __FILE__);
	    return 0;
	}
    }
    return $f_dir;
}    

///////////////////////////////////////////////////////////////////////
// Check a directory or a file be readable or not.
//	$dir_name: directory path name
//	$f_name: file name to be checked in the directory($dir_name)
// if writable, return the path name.
///////////////////////////////////////////////////////////////////////
function ChkReadable( $dir_name, $f_name = ".", $line=__LINE__, $file=__FILE__)
{
  global $TEST;
  if ( $TEST > 3 ) {
    echo "Line: $line";
    include( "print_func_args.php" );
  }

  // Check the directory existence and is readable.
  if (! is_dir($dir_name) ) {
    Error("No directory found: $dir_name", $line, $file);
    Debug("<pre>	Create a directory $dir_name with permission to web server.</pre>", 1);
    Debug("<a href=\"".$_SERVER['PHP_SELF']."\">Return</a>", 1);
    return;
  }
  if (! is_readable("$dir_name") ) {
    Error("Directory is not readable: $dir_name", $line, $file);
    Debug("<pre>	Give file read permission to webserver user.</pre>", 1);
    Debug("<a href=\"".$_SERVER['PHP_SELF']."\">Return</a>", 1);
    return;
  }

  // Check the file existence and is readable if specified
  if ( $f_name !=  "." ) {
    if ( ! file_exists("$dir_name/$f_name") ) {
      Debug("Error($line):  File is not existed: $dir_name/$f_name", 9);
      Debug("<a href=\"".$_SERVER['PHP_SELF']."\">Return</a>", 9);
      return;
    } else {
      if (! is_readable("$dir_name/$f_name") ) {
	Error("File is not readable: $dir_name/$f_name", $line, $file);
	Debug("<pre>   Give file read permission to webserver user.</pre>", 1);
	Debug("<a href=\"".$_SERVER['PHP_SELF']."\">Return</a>", 1);
	return;
      }
    }
  }
  return "$dir_name/$f_name";
}

///////////////////////////////////////////////////////////////////////
// Check a directory or a file be writable or not.
//	$dir_name: directory path name
//	$f_name: file name to be checked in the directory($dir_name)
// if writable, return the path name.
///////////////////////////////////////////////////////////////////////
function ChkWritable( $dir_name, $f_name = ".", $line=__LINE__, $line=__FILE__)
{
  global $TEST;
  if ( $TEST > 3 ) {
    echo "Line: $line";
    include( "print_func_args.php" );
  }

  // Check the directory existence and is writable.
  if (! is_dir("$dir_name") ) {
    Error("No directory found:  $dir_name", $line, $file);
    Debug("<pre>	Create a directory $dir_name with permission to web server.</pre>", 1);
    Debug("<a href=\"".$_SERVER['PHP_SELF']."\">Return</a>", 1);
    return;
  }
  if (! is_writeable("$dir_name") ) {
    Error("Directory is not writable:  $dir_name", $line, $file);
    Debug("<pre>	Give file read/write permission to webserver user.</pre>", 1);
    Debug("<a href=\"".$_SERVER['PHP_SELF']."\">Return</a>", 1);
    return;
  }

  // Check the file no existence nor is writable if specified
  if ( $f_name !=  "." ) {
    if ( file_exists("$dir_name/$f_name") == true ) {
      if (! is_writeable( "$dir_name/$f_name" ) ) {
	Error("File is not writable:  $dir_name/$f_name", $line, $file);
	Debug("<pre>   Give file read/write permission to webserver user.</pre>", 1);
	Debug("<a href=\"".$_SERVER['PHP_SELF']."\">Return</a>", 1);
	return;
      }
    }
  }
  return "$dir_name/$f_name";
}
?>
