<?php
// テアス罕ユ・ゥ。シ・゛・テ・ネ、ヌ、ホ・、・癸シ・ク・�Д院Ε優離好轡�
// (・オ・爭ヘ。シ・�Ε磧◆屐‡Ε漾▲后‡�篷スシィ)
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
