<?php
$contents = read_file_lock($param['LIST_FILE']);
echo "<table>\n";
foreach ($contents as $line) {
    $fields = explode("\t", $line);
    if ( $fields[0] == $foldername ) {
        echo "<H1>$fields[1]</H1>\n";
    }
}

//
// ¡¦¥Ë¡£¥·¡¦¥è¡¦ö§¥æ¡¦¥¥¡£¥·¡¦¡«¡¦¥Æ¡¦¥Í¡¢¥Ì¡¢¥Û¡¦¡¢¡¦â£¥·¡¦¥¯¡¦ô§¥±¡¦¥Í¥Î¥¹¥·¥£
//
if( extension_loaded('gd') ){
    $fh=ImageFontHeight(1);
    $fw=ImageFontWidth(1);
} else {
    // when you donot have GD.
    $fh = 6; 
    $fw = 4; 
}
$nc = $browse_width/($thumbnail_width+$fw);
$nc = (int)$nc;
//$nr = $browse_height/($thumbnail_height+$fh*2);
//$nr = (int)$nr;
Debug ( $nc, 8 );

// list image index in the current directory
// (show icon if existed)
$i=0;
if ($edit_rmk_mode != "n") {
    echo "<TABLE BORDER=1>\n";
} else { //  No-Border
    echo "<TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"0\">\n";
}
while (list ($key, $entry) = each ($items)) {
    if ( is_file("$original_directory_path/$entry") && GetImgPixels("$original_directory_path/$entry") ) {
        $i = $i + 1;
        $mi = $i % $nc ;
        if ( $mi == 1 ) {
            echo "<TR><TD>";
        } else {
            echo "<TD>";
        }
        echo "<FONT SIZE=\"-1\">";
        if ($edit_rmk_mode != "n") {
            if ( GetImgType("$thumbnail_directory_path/$entry") ) {
                echo "<A href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&mode=show&image=$entry\">$entry<br>\n";
                echo "<img src=\"$thumbnail_directory_uri/$entry\"></A><br>\n"; 
            } else {
                echo "<A href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&mode=create&image=$entry\">$entry</A><br>\n";
            }
            $label = RdImgRemark($thumbnail_directory_path, $entry, __LINE__);
            if ($edit_rmk_mode == "a" || $edit_rmk_mode == "o" || $edit_rmk_mode == "r") {
                if ( ! empty($label) ) {
                    $label = ereg_replace ( "--\t--\n", "", $label );
                    $label = ereg_replace ( "\t__ .* __\t\n", "", $label );
                    $label = substr($label, 0, $thumblabel_length) . "...";
                } else {
                    $label = "edit";
                }
                echo "<a href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&mode=edit&image=$entry\">$label</a><br>\n";
            } else {
                echo "$label<br>\n";
            }
        } else { // No-Border, Non-Label
            if ( GetImgType("$thumbnail_directory_path/$entry") ) {
                echo "<A href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&mode=show&image=$entry\">\n";
                echo "<img src=\"$thumbnail_directory_uri/$entry\" BORDER=\"0\"></A><br>\n"; 
            } else {
                echo "<A href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&mode=create&image=$entry\">$entry</A><br>\n";
            }
        }
        echo "</FONT>";
        
        if ( $mi == 0 ) {
            echo "</TD></TR>\n";
        } else {
            echo "</TD>\n";
        }
    }
}
echo "</TABLE>\n";
?>
