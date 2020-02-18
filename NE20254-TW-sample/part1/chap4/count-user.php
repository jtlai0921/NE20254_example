<?php
include_once 'DB.php';

// 開啟保存Session的資源
function open ($save_path, $session_name) {
  global $dbh;

  $dsn = "sqlite://localhost/".$save_path;

  $dbh = DB::connect($dsn, true);
  if (DB::isError($dbh)) {
    die(sprintf("Database open error [%d] : %s",
		$dbh->getCode(), $dbh->getMessage()));
  }
  return (true);
}

// 關閉保存Session的資源
function close() {
  return true; // 因為持續的連結，所以不要關閉
}

// 讀出Session資訊
function read ($id) {
  global $dbh;

  $sSQL = sprintf("SELECT value FROM session_data WHERE sess_id='%s' LIMIT 1", 
		  addslashes($id));
  $result = $dbh->query($sSQL);
  $row = $result->fetchRow(DB_FETCHMODE_NUM);
  return ($row[0]);
}
 
// 寫入Session資訊
function write ($id, $data) {
  global $dbh;
 
  $sSQL = sprintf("SELECT value FROM session_data WHERE sess_id='%s'",
                  addslashes($id));
  $result = $dbh->query($sSQL);
  if ($result->numRows()==1) {
    $sSQL = sprintf("UPDATE session_data SET value='%s', updated=%d WHERE sess_id='%s'",
		    addslashes($data), time(), addslashes($id));		    
  } else {
    $sSQL = sprintf("INSERT INTO session_data VALUES('%s', '%s', %d)",
		    addslashes($id), addslashes($data), time());
  }
  if (DB::isError($dbh->query($sSQL))) {
    return (false);    
  }
  return (true);
}

// 刪除Session變數
function destroy ($id) {
  global $dbh;
  
  $sSQL = sprintf("DELETE FROM session_data WHERE sess_id='%s'", 
		  addslashes($id));
  if(DB::isError($dbh->query($sSQL))) {
   return (false);
  } 
   return (true);
}
 
// 丟棄Session變數
function gc ($maxlifetime) {
  global $dbh;
  
  $sSQL = sprintf("DELETE FROM session_data WHERE (%d - updated) > %d",
                  time(), $maxlifetime);
  if(DB::isError($dbh->query($sSQL))) {
   return (false);
  } 
   return (true);
}

// 設定Session處理函式
session_set_save_handler ("open", "close", "read", "write", "destroy", "gc");
session_save_path('/tmp/sample.db');
 
session_start(); // 開始Session
 
if(!isset($_SESSION['cnt'])){
  $_SESSION['cnt'] = 1;   // 設定計數初始值
} 
 
print "存取次數:" . $_SESSION['cnt']++;
?>
