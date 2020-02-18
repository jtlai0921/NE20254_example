<?php
/*
 * 讀取 Guestlog DB 的留言資料
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// 如果已透過POST資料變數設定日期顯示，就覆蓋引數的設定值
$days = 1;
if (isset($_POST['PASTDAYS'])) {
  if(strtoupper($_POST['PASTDAYS']) == "ALL") {
    $days = 0;
  } elseif (intval($_POST['PASTDAYS']) >= 0) {
    $days = intval($_POST['PASTDAYS']);
  }
} else {
  // 確認引數
  if (!empty($_SERVER['argv'][1])) {
    $days = intval($_SERVER['argv'][1]);
  } else {
    if (! empty($_GET['days']) ) {
      $days = (int)$_GET['days'];
    }
  }
}
?>

<center>
<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=read" method="post">
顯示留言。過去<input type="text" size=4 maxlength=4
               name="PASTDAYS" value="<?php echo $days;?>">天份 (0=顯示全部的留言)
</form>
</center>

<?php
echo "<center><strong>\n";
// 切換天數顯示標籤
switch($days){
 case 0:
   echo "顯示全部的留言";
   break;
 case 1:
   echo "本日の記載表示";
   break;
 case 2:
   echo "顯示今天和昨天的留言";
   break;
 default:
   echo "顯示過去 $days 天的留言";
   break;
}
echo "</strong></center>\n";

// 開啟 guestlogDB
$dbh = gbdbopen($fn);
if ($dbh == false) {
  echo "guestlogDB ($fn): 開啟發生錯誤。<br />";
  include("gbtrailer.php");
  exit;
} else {
// 使用 DBM 的情形
// (1) 從 DBM 檔讀出符合條件的所有雜湊鍵
//	$datekey = dbmfirstkey($dbmid);
//	$i=0;
//	while($datekey){
//	  if($datekey!="GUESTBOOKPASS") {
//	    $keyday = intval(date("Y",$datekey))*365+date("z",$datekey);
//	    $today = intval(date("Y"))*365+date("z");
//	    if(($today - $keyday < $days) || $days==0) {
//	      $keys[$i] = $datekey;
//	      $i++;
//	    }
//	  } else {
//	    if($DEBUG)echo "GUESTBOOKPASS=\"".dbmfetch($dbmid,$datekey)."\"<br />\n";
//	  }
//	  $datekey = dbmnextkey($dbmid,$datekey);
//	}
// (2) 排序雜湊鍵的陣列
//	if (is_array($keys)) sort($keys);
// (3) 逆向顯示結果
//	$j=$i-1;
//	while($j>=0){
//	  // 按順序搜尋 DBM 檔案內的對應資料
//	  $entry = dbmfetch($dbmid,$keys[$j]);
//	  // 根據 TAB 切開欄位
//	  $name = strtok($entry,"\t");
//	  $email = strtok("\t");
//	  $comment = strtok("\t");
//	  $entrydate = date("D M d/y H:i:s",$keys[$j]);
//	  echo <<<EOF4
//	    <b><i>$name</i></b>
//	    &lt;<a href="mailto: $email">$email</a>&gt;
//	    <b>$entrydate</b>
//	    <font size=-1><a href="{$_SERVER['PHP_SELF']}?admin+$keys[$j]">
//	    &lt;entry id: $keys[$j]&gt;</a></font>
//	    <br>$comment<br>
//	EOF4;
//	    $j--;
//	}

  // SQL 資料庫的作法如下
  if ( $days > 0 ) {
    $today = time();
    $stadate = $today - $days*3600*24;
    // Select rows
    $sql = "SELECT * FROM note_tbl WHERE date >= $stadate ORDER BY date DESC";
  } else {
    $sql = "SELECT * FROM note_tbl ORDER BY date DESC";
  }
  $res = $dbh->getAll($sql, DB_FETCHMODE_ASSOC);
  if (DB::isError($res)){
    $msg .= $res->getMessage()."\n";
    echo $msg;
  }
  
  // Output result
  echo "<table borderwith='0'>\n";
  foreach ($res as $row => $cols){
    $name = strip_tags($cols['name']);
    $email = strip_tags(implode(' at ',explode('@', $cols['mail'])));
    $comment = strip_tags($cols['note']);
    $entrydate = date("D M d Y H:i:s",$cols['date']);
    
    echo <<<EOF4
 <tr><td colspan='4'><br />$comment<br /></td></tr>
 <tr>
  <td><font size="-1"><b><i>$name</i></b></font></td>
  <td><font size="-1">&lt;<a href="mailto: $email">$email</a>&gt;</font></td>
  <td><font size="-1"><b>$entrydate</b></font></td>
  <td><font size="-2">&lt; <a href="{$_SERVER['PHP_SELF']}?mode=admin&date=${cols['date']}">Edit </a>${cols['date']} &gt;</font></td>
 </tr>
EOF4;
  }
  echo "</table>\n";
}
gbdbclose($dbh);
?>
