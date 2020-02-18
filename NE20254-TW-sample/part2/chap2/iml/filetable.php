<?php
/* Imagelist File Table Class
 * This is file based simplified database which has write exclusion.
 * File format:
 *  recursive file version number in the 1st record and 
 *  tab seperated records follow it.
 *
 */
define('BACKUP_NUM_LIMIT', 10);

class FileTable {
  //private $file;	// File path
  //private $count;	// Backup Number
  //private $table = array();	// Table contents
  //private $errmsg;	// Error message
  var $file;	// File path
  var $count;	// Backup Number
  var $table = array();	// Table contents
  var $errmsg;	// Error message

  function FileTable ( $filepath ) {
    $this->file = $filepath;
    if (! file_exists($filepath) ) {
      // 第一次進入
      $this->count = 1;
      $this->write();
    } else {
      $this->read();
    }
  }

  function maxrow ( ) {
    return count($this->table);
  }

  //private function read ( ) {
  function read ( ) {
    // 將既存檔案讀入至陣列
    $buffer = file($this->file);
    if (! is_array($buffer) ) {
      $this->errmsg = "No array in the DB file: ".$this->file;
      return false;
    }
    // 倒數第一列的最後Backup號碼
    $bkn = (int)strtok( array_shift($buffer), "," );
    if ( $bkn >= BACKUP_NUM_LIMIT ) {
      $this->count = 1;
    } else {
      $this->count = $bkn + 1;
    }
    // 以剩餘以表儲存
    $this->table = $buffer;
  }

  //private function write ( ) {
  function write ( ) {
    // create lock file
    $lockfile = $this->file . ".lck";
    if ( file_exists($lockfile) ) {
      $this->errmsg = "DB file already locked: ".$this->file;
      return false;
    }
    touch ($lockfile);
    
    // 輸出新DB檔案
    $fp = fopen($this->file, "w");
    if ( ! fprintf($fp, "%03d,\n",$this->count) ) {
      $this->errmsg = "DB file writing count failed: ".$this->file;
      fclose($fp);
      unlink($lockfile);
      return false;
    }
    while ( list($k, $v) = each($this->table) ) {
      $v = trim($v);
      if (! empty($v) ) {
        if (! fprintf($fp, "%s\n", $v) ) {
          $this->errmsg = "DB file writing table failed: ".$this->file;
          fclose($fp);
          unlink($lockfile);
          return false;
        }
      }
    }
    fclose($fp);
    chmod($this->file, myfilemode());
    
    // drop lock file
    unlink ($lockfile);
    return $this->maxrow();
  }

  function geterr ( ) {
    return $this->errmsg;
  }

  function getall ( ) {
    $this->read();
    return $this->table;
  }

  function getrow ($i) {
    $this->read();
    if ( count($this->table) < $i ) {
      $this->errmsg = "Number of rows is less than specified value: ".$i;
      return false;
    }
    return $this->table[$i];
  }

  function addrow ($row) {
    $this->read();
    if ( empty($row) ) {
      $this->errmsg = "Empty row specified.";
      return false;
    }
    array_push( $this->table, $row );
    return $this->write();
  }

  function setall ($table) {
    if ( ! is_array($table) ) {
      $this->errmsg = "Not a array specified for table.";
      return false;
    }
    $this->read();
    $this->table = $table;
    return $this->write();
  }

}
?>
