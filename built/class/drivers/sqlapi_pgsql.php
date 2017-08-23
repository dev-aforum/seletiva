<?
/*
 * SQLAPI PostgreSQL Driver
 * Versao: 0.1
 * Autor: Anselmo Daniel Adams <adams@cafeautomatic.com.br>
 * Copyright CafeAutomatic 2004
 */
/*
bootstrap
*/
$SQLAPI_DRVARR[] = "pgsql";
define("SQLAPI_PGSQL_CNXERROR","Erro ao conectar-se com o banco de dados.");
define("SQLAPI_PGSQL_NOQUERY","Consulta não informada.");
define("SQLAPI_PGSQL_INVALID_QPOINTER","Ponteiro de consulta inválido.");
define("SQLAPI_PGSQL_EOD","sei lá que pau que deu, meu chapa! te vira.");
/*
end bootstrap
*/

class SQLAPI_PGSQL {
	/* 
	 * $error
	 * @value
	 */
	var	$error = "";

	/* 
	 * $dbhost
	 * @value
	 */
	var	$dbhost = "";

	/* 
	 * $dbpwd
	 * @value
	 */
	var	$dbpwd = "";

	/* 
	 * $dbuser
	 * @value
	 */
	var	$dbuser = "";

	/* 
	 * $dbname
	 * @value
	 */
	var	$dbname = "";

	/* 
	 * $dbport
	 * @value
	 */
	var	$dbport = "";

	/* 
	 * set_access
	 * @method
	 */
//$this->handler->set_access($this->dbuser,$this->dbpwd,$this->dbhost,$this->dbname,$this->dbport);
	function set_access($dbuser = "", $dbpwd = "", $dbhost = "", $dbname = "", $dbport = "") {
		if(is_a($this,__CLASS__)) {
			$this->dbuser = $dbuser;
			$this->dbpwd = $dbpwd;
			$this->dbhost = $dbhost;
			$this->dbname = $dbname;
			$this->dbport = $dbport;
		} else {
			return false;
		}
	}

	function _start() {
		if(is_a($this,__CLASS__)) {
			$connstr = "";
			if(!empty($this->dbhost)) {
				$connstr .= "host=".$this->dbhost . " ";
			}
			if(!empty($this->dbname)) {
				$connstr .= "dbname=" . $this->dbname . " ";
			}
			if(!empty($this->dbpwd)) {
				$connstr .= "password=" . $this->dbpwd . " ";
			}
			if(!empty($this->dbuser)) {
				$connstr .= "user=" . $this->dbuser . " ";
			}
			if(!empty($this->dbport)) {
				if(ereg("^[0-9]$",$this->dbport)) {
					$connstr .= "port=" . $this->dbport;
				}
			}
			//echo $connstr;
			$cnx = pg_connect($connstr);
			if(!$cnx) {
				$this->error = SQLAPI_PGSQL_CNXERROR;
				return false;
			} else {
				$this->cnx = $cnx;
				return true;
			}
		} else {
			return false;
		}
	}
	/*
	 * _execute
         * @method
	 */
	function _execute($statement = "") {
		if(is_a($this,__CLASS__)) {
			if(!empty($statement)) {
				$res = @pg_exec($statement);
				if(is_resource($res)) {
					return $res;
				} else {
					$this->error = "Query exec error";
					return false;
				}
			} else {
				$this->error = SQLAPI_PGSQL_NOQUERY;
				return false;				
			}
		} else {
			return false;
		}
	}
	/*
	 * _get_info
	 * @method
	 */
	function _get_info() {
		if(is_a($this,__CLASS__)) {
			$this->error = SQLAPI_UNIMPLEMENTED;
			return false;
		} else {
			return false;
		}
	}
	/*
	 * _close()
	 * @method
	 */
	function _close() {
		if(is_a($this,__CLASS__)) {
			@pg_close($this->cnx);
		} 			
	}	

}

class SQLAPI_RES_PGSQL {
	/*
	 * $error
	 * @value
	 */
	var	$error = "";
	/*
	 * get_statement_info()
	 * @method
	 */
	function get_statement_info($qp) {
		if(is_a($this,__CLASS__)) {
			$this->error = SQLAPI_UNIMPLEMENTED;
			return false;
		} else {
			return false;
		}
	}
	/*
	 * get_info()
	 * @method
	 */
	function get_info($qp) {
		if(is_a($this,__CLASS__)) {
			return 1;
		} else {
			return false;
		}
	}
	/*
	 * _numrows()
	 * @method
	 */
	function _numrows($qp) {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				return @pg_numrows($qp);	
			} else {
				$this->error = SQLAPI_PGSQL_INVALID_QPOINTER;
				return false;				
			}
		} else {
			return false;
		}
	}

	/*
	 * _affected_rows()
	 * @method
	 */
	function _affected_rows($qp) {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				return @pg_affected_rows($qp);
			} else {
				$this->error = SQLAPI_PGSQL_INVALID_QPOINTER;
				return false;				
			}
		} else {
			return false;
		}
	}

	/*
	 * _fetch_row()
	 * @method
	 */
	function _fetch_row($qp) {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				$row = @pg_fetch_row($qp);
				if(!$row) {
					$this->error = SQLAPI_PGSQL_EOD;
					return false;					
				} else {
					return $row;
				}
			} else {
				$this->error = SQLAPI_PGSQL_INVALID_QPOINTER;
				return false;				
			}
		} else {
			return false;
		}
	}
	/*
	 * _fetch_assoc()
	 * @method
	 */
	function _fetch_assoc($qp) {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				$row = @pg_fetch_assoc($qp);
				if(!$row) {
					$this->error = SQLAPI_PGSQL_EOD;
					return false;					
				} else {
					return $row;
				}
			} else {
				$this->error = SQLAPI_PGSQL_INVALID_QPOINTER;
				return false;				
			}			
		} else {
			return false;
		}
	}
	/*
	 * _fetch_object()
	 * @method
	 */
	function _fetch_object($qp) {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				$row = @pg_fetch_object($qp);
				if(!$row) {
					$this->error = SQLAPI_PGSQL_EOD;
					return false;					
				} else {
					return $row;
				}				
			} else {
				$this->error = SQLAPI_PGSQL_INVALID_QPOINTER;
				return false;				
			}
		} else {
			return false;
		}
	}

	/*
	 * _fetch_xml()
	 * @method
	 */
	function _fetch_xml($qp) {
		if(is_a($this,__CLASS__)) {
			$this->error = SQLAPI_UNIMPLEMENTED;
			return false;
		} else {
			return false;
		}
	}
	/*
	 * _freeresult()
         * @method
	 */
	function _freeresult($qp) {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				@pg_free_result($qp);
			} else {
				$this->error = SQLAPI_PGSQL_INVALID_QPOINTER;
				return false;				
			}
		} else {
			return false;
		}
	}
}

?>
