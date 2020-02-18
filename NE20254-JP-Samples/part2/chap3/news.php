<!-- news //-->
<tr>
 <td>
<?php
mysql_select_db("test"); // 
$result = tep_db_query("SELECT * FROM news LIMIT 5");   

if (@tep_db_num_rows($result) > 0) {
  
  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'text'  => 'ニュース');
  $str = "";
  while ($d = tep_db_fetch_array($result)) {
    $str .= "<a href=\"{$d['link']}\">{$d['title']}</a><br>\n";
  }
  new infoBoxHeading($info_box_contents);
  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'text'  => $str);
  new infoBox($info_box_contents);
  mysql_select_db(DB_DATABASE); //
}
?>
 </td>
</tr>
<!-- news_eof //-->
