<?php
/*
 * DB Access Class for ImageList 2005
 *
 *    2005-02-28 JuK add filepermision setting, myfilemode()
 */
require_once 'DB.php';
require_once 'checkutil.php';

Class MyDB extends DB {
	
	private $dbh='';
	private $msg='';
	private $res='';
	private $sql='';

	function __construct ( $dsn = '') {
        $fmode = decoct(myfilemode());
        // DSN: Data Source Name 
        if ( empty($dsn) ) {
            // DSN for SQLite
            // $dsn = "sqlite:///test.db";
            $dsn = array (
                          'phptype'  => "sqlite",		// DBMS
                          'database' => "test.db",		// DBname
                          'mode'	 => $fmode	// permission
                          );

            // DSN for PostgreSQL
            //$dsn="pgsql://www:wadm@localhost/test";
        }
        if (! is_array($dsn) ) {
            $da = explode("/", $dsn);
            $dsn = array( 
                         'phptype' => trim($da[0], ":"),
                         'database' => implode( "/", array_slice($da, 3) ),
                         'mode' => $fmode
                         );
        }
        //var_dump($dsn);
        
		// Connect DB
		$this->dbh = DB::connect($dsn);
		if (DB::isError($this->dbh)) {
            $this->msg = "Connect error: ".$this->dbh->getMessage();
			return false;
		}
		return true;
	}

	function getMessage () {
		return $this->msg;
	}

	function close () {
		if (! empty($this->dbh) ) {
			// Disconnect DB
			$this->dbh->disconnect();
		}
	}

	function create ($schemas) {
		if (DB::isError($this->dbh)){
            $this->msg = "CREATE error: No DB Handler.";
            return false;
        }
        if (! is_array($schemas) ) {
            $this->msg = "CREATE error: schemas is not an array.";
            return false;
        }
        // Create tables
        while( list($tbl, $sch) = each($schemas) ) {
            if (! is_array($sch) ) {
                $this->msg = "CREATE error: schema is not an array.";
                return false;
            }
            // Set SQL
            $this->sql = "CREATE TABLE $tbl (\n";
            $cols = array();
            while( list($col, $attr) = each($sch) ) {
                if ( empty($attr) ) {
                    $this->msg = "CREATE error: attribute is empty.";
                    return false;
                }
                $cols[] = "$col $attr";
            }
            $this->sql .= implode(",\n", $cols);
            $this->sql .= "\n);";
            // Query
            $this->res = $this->dbh->query($this->sql);
            if (DB::isError($this->res)){
                $this->msg = "CREATE error: ".$this->res->getMessage();
                return false;
            }
        }
		return true;
    }

    function exists ($dbname) {
        if ( empty($this->dbh) || DB::isError($this->dbh) ) {
            return false;
        } else {
            return true;
        }
    }

    function tbl_exists ($table) {
        $ret = $this->select ($table, 'count(*) as n');
        if (DB::isError($this->res)){
            return false;
        }
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

    function insert ($table, $tuple) {
        if (! is_array($tuple)){
            $this->msg = "INSERT error: tuple is not an array.";
            return false;
        }
        // Set SQL
        while( list($key, $val) = each($tuple) ) {
            $cols[] = $key;
            $vals[] = "'$val'";
        }
        $this->sql = "INSERT into $table";
        $this->sql .= " (".implode(",", $cols).") VALUES (".implode(",", $vals).");";
        // Qeury
        $this->res = $this->dbh->query($this->sql);
        if (DB::isError($this->res)){
            $msg = "INSERT error: ".$this->res->getMessage();
            return false;
        }
        return true;
    }

    function select ($table, $column, $condition='') {
        // Set SQL
        $this->sql = "SELECT $column FROM $table";
        if (! empty($condition) ) {
            $this->sql .= " WHERE $condition";
        }
        // Query
        $this->res = $this->dbh->query($this->sql);
        if (DB::isError($this->res)){
            $this->msg = "SELECT error: ".$this->res->getMessage();
            return false;
        }
        return true;
    }

    function select_single ($table, $column, $condition='') {
        if (! $this->select($table, $column, $condition)) { 
            return false;
        }
        $entry = $this->res->fetchRow(DB_FETCHMODE_ASSOC);
        $this->res->free();
        if (! is_array($entry)) {
            $this->msg = "SELECT_SIGLE error: no entry selected.";
            return false;
        }
        return $entry;
    }

    function delete ($table, $condition='') {
        if (! empty($condition)){
            $this->msg = "DELETE error: No condition specified.";
            return false;
        }
        // Set SQL
        $this->sql = "DELETE FROM $table";
        if (! empty($condition) ) {
            $this->sql .= " WHERE $condition";
        }
        // Query
        $this->res = $this->dbh->query($this->sql);
        if (DB::isError($this->res)){
            $this->msg = "DELETE error: ".$this->res->getMessage();
            return false;
        }
        return true;
    }

    function update ($table, $tuple, $condition='') {
        if (! is_array($tuple)){
            $this->msg = "UPDATE error: tuple is not an array.";
            return false;
        }
        // Set SQL
        $cols = array();
        while (list($col, $val) = each ($tuple)) {
            $cols[] = "$col = $val";
        }
        $setcols = implode(",", $cols);
        $this->sql = "UPDATE $table SET $setcols";
        if (! empty($condition) ) {
            $this->sql .= " WHERE $condition";
        }
        // Query
        $this->res = $dbh->query($this->sql);
        if (DB::isError($this->res)){
            $this->msg = "UPDATE error: ".$this->res->getMessage();
            return false;
        }
        return;
    }

}

//
// Methods for MyAuth
//
function create_usertbl ($dsn, $user, $pass) {
    //    $dsn = array (
    //                  'phptype'  => "sqlite",	// DBMS
    //                  'database' => "auth.db",	// DBname
    //                  'mode'	 => 646			// permission
    //              );
    $mydb = new MyDB($dsn);
    $schemas=array();
    $schemas['usertbl'] = array( 'userid' => 'NAME PRIMARY KEY',
                                 'passwd' => 'TEXT');
    if (! $mydb->create($schemas) ) {
        Error($mydb->getMessage(), __LINE__, __FILE__);
        //return false;
    }
    $tuple=array();
    $tuple['userid']=$user;
    $tuple['passwd']=$pass;
    if (! $mydb->insert('usertbl', $tuple) ) {
        Error($mydb->getMessage(), __LINE__, __FILE__);
        return false;
    }
    return true;
}

function create_future () {
		//
		// Create tables
		//
	
		// step1
		$this->sql = <<<EOQ1
			CREATE TABLE user_tbl (
								   id SERIAL PRIMARY KEY,
								   adm BOOLEAN NOT NULL DEFAULT 'f',
								   name VARCHAR(64) NOT NULL,
								   pass VARCHAR(64) NOT NULL,
								   mail VARCHAR(128),
								   remark VARCHAR(128)
								   );
EOQ1;
		$this->res = $this->dbh->query($this->sql);
		if (DB::isError($this->res)){
            $this->msg = "CREATE error: ".$this->res->getMessage();
			return false;
		}
		
		// step2
		$this->sql = <<<EOQ2
			CREATE TABLE note_tbl (
								   id SERIAL PRIMARY KEY,
								   date INT4 NOT NULL,
								   name VARCHAR(64) NOT NULL,
								   mail VARCHAR(128),
								   note TEXT NOT NULL
								   );
EOQ2;
		$this->res = $this->dbh->query($this->sql);
		if (DB::isError($this->res)){
            $this->msg = "CREATE error: ".$this->res->getMessage();
			return false;
		}
		return true;
}

?>
