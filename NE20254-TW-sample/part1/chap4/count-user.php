<?php
include_once 'DB.php';

// �}�ҫO�sSession���귽
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

// �����O�sSession���귽
function close() {
  return true; // �]�����򪺳s���A�ҥH���n����
}

// Ū�XSession��T
function read ($id) {
  global $dbh;

  $sSQL = sprintf("SELECT value FROM session_data WHERE sess_id='%s' LIMIT 1", 
		  addslashes($id));
  $result = $dbh->query($sSQL);
  $row = $result->fetchRow(DB_FETCHMODE_NUM);
  return ($row[0]);
}
 
// �g�JSession��T
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

// �R��Session�ܼ�
function destroy ($id) {
  global $dbh;
  
  $sSQL = sprintf("DELETE FROM session_data WHERE sess_id='%s'", 
		  addslashes($id));
  if(DB::isError($dbh->query($sSQL))) {
   return (false);
  } 
   return (true);
}
 
// ���Session�ܼ�
function gc ($maxlifetime) {
  global $dbh;
  
  $sSQL = sprintf("DELETE FROM session_data WHERE (%d - updated) > %d",
                  time(), $maxlifetime);
  if(DB::isError($dbh->query($sSQL))) {
   return (false);
  } 
   return (true);
}

// �]�wSession�B�z�禡
session_set_save_handler ("open", "close", "read", "write", "destroy", "gc");
session_save_path('/tmp/sample.db');
 
session_start(); // �}�lSession
 
if(!isset($_SESSION['cnt'])){
  $_SESSION['cnt'] = 1;   // �]�w�p�ƪ�l��
} 
 
print "�s������:" . $_SESSION['cnt']++;
?>
