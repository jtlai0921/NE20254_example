<?php
// ��ܳ�®榡�ƪ�imagelist
// (�Y��thumbnail�N�������)
while (list ($key, $entry) = each ($items)) {
    if ( GetImgType("$original_directory_path/$entry") ) {
        if ( GetImgType("$thumbnail_directory_path/$entry") ) {
            echo "<A href=\"$original_directory_uri/$entry?folder=$foldername\"><br>\n"; 
            echo "$entry<br>\n";
            echo "<img src=\"$thumbnail_directory_uri/$entry\"><br>\n"; 
            echo "</A><br>\n"; 
        } else {
            echo "<a href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&mode=show&image=$entry\">$entry</a><br>\n";
        }
    }
}
?>
