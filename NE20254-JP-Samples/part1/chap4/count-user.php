<?php
include_once 'DB.php';

// セッションを保存するリソースをオープン
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

// セッションを保存するリソースをクローズ
function close() {
  return true; // 持続的接続のためクローズ処理不要
}

// セッション情報を読み込む
function read ($id) {
  global $dbh;

  $sSQL = sprintf("SELECT value FROM session_data WHERE sess_id='%s' LIMIT 1", 
		  addslashes($id));
  $result = $dbh->query($sSQL);
  $row = $result->fetchRow(DB_FETCHMODE_NUM);
  return ($row[0]);
}
 
// セッション情報を書き込む
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

// セッション変数を削除する
function destroy ($id) {
  global $dbh;
  
  $sSQL = sprintf("DELETE FROM session_data WHERE sess_id='%s'", 
		  addslashes($id));
  if(DB::isError($dbh->query($sSQL))) {
   return (false);
  } 
   return (true);
}
 
// セッション情報を破棄する
function gc ($maxlifetime) {
  global $dbh;
  
  $sSQL = sprintf("DELETE FROM session_data WHERE (%d - updated) > %d",
                  time(), $maxlifetime);
  if(DB::isError($dbh->query($sSQL))) {
   return (false);
  } 
   return (true);
}

// セッションハンドラを設定
session_set_save_handler ("open", "close", "read", "write", "destroy", "gc");
session_save_path('/tmp/sample.db');
 
session_start(); // セッションを開始
 
if(!isset($_SESSION['cnt'])){
  $_SESSION['cnt'] = 1;   // カウンタ初期値設定
} 
 
print "アクセス回数: " . $_SESSION['cnt']++;
?>
