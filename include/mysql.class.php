<?php
 
class Mysql {

	var $Server;
	

	var $User;
	

	var $Pass = '';
	

	var $DbName;
	
	
	var $Flags = false;
	

	var $Query = NULL;
	

	var $Result = NULL;
	

	var $Db_Link;
	

	function Mysql ($host, $dbuname, $dbpass, $dbname, $flags = false) {
		$this->Server = $host;
		$this->User = $dbuname;
		$this->Pass = $dbpass;
		$this->DbName = $dbname;
		$this->Flags = $flags;
	}
	

	function Database_Connect() {
		if($this->Flags) {
			$this->Db_Link = @mysql_pconnect($this->Server, $this->User, $this->Pass);
		} else {
			$this->Db_Link = @mysql_connect($this->Server, $this->User, $this->Pass);
		}
		if($this->Db_Link) {
			if(mysql_select_db($this->DbName, $this->Db_Link)) {
				return true;
			} else {
				return false;
			}
		}
	}
	

	function sql_query($sql) {
		if(!empty($sql)) {
			if(!$this->Query = mysql_query($sql)) {
				return false;
			} else {
				return true;
			}
		}
	}
	

	function sql_getrows($sql) {
		$result = mysql_query($sql) or die(mysql_error());
		return (mysql_num_rows($result));
	}

	function sql_fetchassoc() {
		if(!isset($this->Query)) {
			return false;
		} else {
			return (mysql_fetch_assoc($this->Query));
		}
	}
	

	function sql_fetchrow() {
		if(!isset($this->Query)) {
			return false;
		} else {
			return (mysql_fetch_array($this->Query));
		}
	}	
	
	function sql_fetcharray() {
		if(!isset($this->Query)) {
			return false;
		} else {
			return (mysql_fetch_array($this->Query));
		}
	}
	

	function sql_freeresult() {
		if(!isset($this->Query)) {
			return false;
		} else {
			return (mysql_free_result($this->Query));
		}
	}
	function sql_result() {
		if(!isset($this->Query)) {
			return false;
		} else {
			return (mysql_result($this->Query));
		}
	}
	

	function escape($data) {
		if(!empty($data)) {
			return (mysql_real_escape_string($data));
		} else {
			return false;
		}
	}
	

	function undo_escape($data) {
		if(!empty($data)) {
			return (stripslashes($data));
		} else {
			return false;
		}
	}
	

	function sql_close() {
		if(!isset($this->Db_Link)) {
			return false;
		} else {
			mysql_close($this->Db_Link);
			return true;
		}
	}
	
	
	function error($mysql_db_link) {
		$mysql_db_link = '';
		return die(mysql_error());
	}
	
	function flush()
	{
		return $this->Query = '';
	}
}
?>