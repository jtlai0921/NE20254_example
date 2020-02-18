<?php
/*
 * DB Access functions for GustLog 2005
 *
 */
require_once("DB.php");

function gbdbopen ( $dbname = 'test')
{
	// DSN: Data Source Name 

    // DSN for SQLite
	// $dsn = "sqlite:///test.db";
	$dsn = array (
                'phptype'  => "sqlite",		// DBMS
                'database' => "$dbname.db",	// DBname
                'mode'     => 646		// permission
                );
    // DSN for PostgreSQL
	//$dsn="pgsql://www:wadm@localhost/$dbname";
  
	// Connect DB
	$dbh = DB::connect($dsn);
	if (DB::isError($dbh)) {
		echo $dbh->getMessage()."\n";
		return false;
	}
	return $dbh;	// database handler
}

function gbdbclose ($dbh)
{
	if (! empty($dbh) ) {
		// Disconnect DB
		$dbh->disconnect();
	}
}

function gbdbinit ($dbh)
{
	//
	// Create tables
	//
	
	// step1
	$sql = <<<EOQ1
    CREATE TABLE user_tbl (
                           id SERIAL PRIMARY KEY,
                           adm BOOLEAN NOT NULL DEFAULT 'f',
                           name VARCHAR(64) NOT NULL,
                           pass VARCHAR(64) NOT NULL,
                           mail VARCHAR(128),
                           remark VARCHAR(128)
                           );
EOQ1;
	$res = $dbh->query($sql);
	if (DB::isError($res)){
		echo $res->getMessage()."\n";
		return false;
	}
  
	// step2
	//($GuestTime,"$GuestName\t$GuestEmail\t$GuestComment");
	$sql = <<<EOQ2
    CREATE TABLE note_tbl (
                           id SERIAL PRIMARY KEY,
                           date INT4 NOT NULL,
                           name VARCHAR(64) NOT NULL,
                           mail VARCHAR(128),
                           note TEXT NOT NULL
                           );
EOQ2;
	$res = $dbh->query($sql);
	if (DB::isError($res)){
		echo $res->getMessage()."\n";
		return false;
	}

	return true;
}

function gbdbexists ($dbname)
{
	if ( ($dbh = gbdbopen($dbname)) === false ) {
		return false;
	} else {
		return gbdbtblexists($dbh, 'user_tbl');
	}
}

function gbdbtblexists ($dbh, $table)
{
    $ret = gbdbselect ($dbh, $table, 'count(*) as n');
    if ( empty($ret) ) {
        return false;
    } else {
        if ( isset( $ret['n'] ) ) {
            return $ret['n'];
        } else {
            return false;
        }
    }
}

function gbdbinsert ($dbh, $table, $tuple)
{
	while( list($key, $val) = each($tuple) ) {
		$cols[] = $key;
		$vals[] = "'$val'";
	}
  
	$sql = "INSERT into $table";
	$sql .= " (".implode(",", $cols).") VALUES (".implode(",", $vals).");";
	$res = $dbh->query($sql);
	if (DB::isError($res)){
		return "INSERT error: ".$res->getMessage()."\n";
	}
	return;
}

function gbdbselect ($dbh, $table, $column, $condition='')
{
	$sql = "SELECT $column FROM $table";
	if (! empty($condition) ) {
		$sql .= " WHERE $condition";
	}
	$res = $dbh->query($sql);
	if (DB::isError($res)){
		//echo  "SELECT error: ".$res->getMessage()."\n";
		return false;
	}
	$entry = $res->fetchRow(DB_FETCHMODE_ASSOC);
	$res->free();
	if (is_array($entry)) {
		return $entry;
	} else {
		return;
	}
}

function gbdbaddrecord( $dbh, $time, $comment )
{
	//$GuestTime,"$GuestName\t$GuestEmail\t$GuestComment"
	$tuple['date'] = $time;
	$flds = explode("\t", $comment);
	$tuple['name'] = addslashes($flds[0]);
	$tuple['mail'] = addslashes($flds[1]);
	$tuple['note'] = addslashes($flds[2]);

	return gbdbinsert ($dbh, 'note_tbl', $tuple);
}

function gbdbdelete ($dbh, $table, $condition='')
{
	$sql = "DELETE FROM $table";
	if (! empty($condition) ) {
		$sql .= " WHERE $condition";
	}
	$res = $dbh->query($sql);
	if (DB::isError($res)){
		return "DELETE error: ".$res->getMessage()."\n";
	}
	return true;
}

function gbdbupdate ($dbh, $table, $column, $value, $condition='')
{
	$sql = "UPDATE $table SET $column = $value";
	if (! empty($condition) ) {
		$sql .= " WHERE $condition";
	}
	$res = $dbh->query($sql);
	if (DB::isError($res)){
		return "UPDATE error: ".$res->getMessage()."\n";
	}
	return;
}

function gbdbupdatearray ($dbh, $table, $colarray, $condition='')
{
	$cols = array();
	while (list($col, $val) = each ($colarray)) {
		$cols[] = "$col = $val";
	}
	$setcols = implode(",", $cols);
	$sql = "UPDATE $table SET $setcols";
	if (! empty($condition) ) {
		$sql .= " WHERE $condition";
	}
	$res = $dbh->query($sql);
	if (DB::isError($res)){
		return "UPDATE error: ".$res->getMessage()."\n";
	}
	return;
}
?>
