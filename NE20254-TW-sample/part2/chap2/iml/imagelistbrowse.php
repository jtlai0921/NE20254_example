<?php
//$Ver = explode(".",phpversion());
if ($Ver[0] > 4) {
  require_once "filetable.php";
  $ft = new FileTable( $param['LIST_FILE'] );
  $contents = $ft->getall();
} else {
  $contents = read_file_lock($param['LIST_FILE']);
}

foreach ($contents as $line) {
    $fields = explode("\t", $line);
    if ( $fields[0] == $foldername ) {
        echo "<H1>$fields[1]</H1>\n";
    }
}

$nc = 1;

// list image index in the current directory
// (show icon if existed)
$i=0;
if ($print != 1) {
    echo "<TABLE BORDER=0>\n";
} else { //  No-Border
    echo "<TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"0\">\n";
}
while (list ($key, $entry) = each ($items)) {
    if ( is_file("$original_directory_path/$entry") && GetImgPixels("$original_directory_path/$entry") ) {

	$content = '';
	$label = RdImgRemark($thumbnail_directory_path, $entry, __LINE__);
	if ($edit_rmk_mode == "a" || $edit_rmk_mode == "o" || $edit_rmk_mode == "r") {
	    if ( ! empty($label) ) {
		$label = ereg_replace ( "--\t--\n", "", $label );
		$label = ereg_replace ( "\t__ .* __\t\n", "", $label );
		$label = ereg_replace ( "\t__ .* __\t", "", $label );
		$lines = explode("\n", $label);
		$label = array_shift($lines);
		$content = implode("<br>", $lines);
	    }
	}

        $i = $i + 1;
        $mi = $i % $nc ;
        if ( $mi == 1 ) {
            echo "<tr><td>";
        } else {
            echo "<td>";
        }

        echo "<a name=\"$entry\">\n";
        echo "<table border=\"0\" cellspacing=\"2\" cellpadding=\"2\">\n";
        echo "<tr colspan='2'><td><b>".$label."</b></td></tr>\n";
        echo "<tr><td width=\"$work_width\">";

        if ($print != 1) {
            if ( GetImgType("$work_directory_path/$entry") ) {
                echo "<A href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&mode=max&image=$entry\">";
                echo "<img src=\"$work_directory_uri/$entry\"></A><br>\n"; 
            } else {
                echo "<A href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&mode=create&image=$entry\">$entry</A><br>\n";
            }
	    echo "</td><td width=\"$work_width\">\n";
            echo "<font size=\"-1\">";
	    echo "$content<br>\n";
            echo "<div align='center'>\n";
            echo "<a href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&mode=editmax&image=$entry\">edit</a><br>\n";
            echo "</div>\n";
            echo "</font>";
        } else { // No-Border for Print
            echo "<div align='center'>\n";
            if ( GetImgType("$work_directory_path/$entry") ) {
                if (! file_exists("$work_directory_path/org.$imagename") ) {
                  if (! ReCreatImg( 0, 0, -1, 0, $entry, $work_directory_path, $original_directory_path, $remarktext, $rotateangle, $smooth, $zoom, $aspect, "jpeg" ) ) {
                    Error("creating original size image.", __LINE__);
                  }
                }
                $wpix = $work_width;
                $hpix = $work_height;
                $pixels = explode("x", GetImgPixels("$work_directory_path/org.$entry"));
                if ( $wpix > (int)$pixels[0] ) {
                  $wpix = (int)$pixels[0];
                }
                if ( $hpix > (int)$pixels[1] ) {
                  $hpix = (int)$pixels[1];
                }
                echo "<img src=\"$work_directory_uri/org.$entry\" width=\"{$wpix}\" height=\"{$hpix}\" BORDER=\"0\"></A><br>\n"; 
            } else {
                echo "<A href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&mode=create&image=$entry\">$entry</A><br>\n";
            }
            echo "</div>\n";
	    echo "</td><td width=\"$work_width\">\n";
            echo "<font size=\"-1\">";
	    echo "$content<br>\n";
            echo "</font>";
        }
        echo "</td></tr></table>\n";
        echo "</a>\n"; // name=$entry
        
        if ( $mi == 0 ) {
            echo "</td></tr>\n";
        } else {
            echo "</td>\n";
        }
        echo "<tr colspan='2'><td><br /></td></tr>\n";
    }
}
echo "</TABLE>\n";
?>
