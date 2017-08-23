<?
/*
 * SQLAPI MySQL Driver
 * Versao: 0.1
 * Autor: Anselmo Daniel Adams <adams@cafeautomatic.com.br>
 * Copyright CafeAutomatic 2004
 */
/*
bootstrap
*/
$SQLAPI_DRVARR[] = "mysql";
ini_set('mysql.trace_mode','0');
define("SQLAPI_MYSQL_CNX_ERROR","Erro ao conectar-se ao banco de dados MySQL");
define("SQLAPI_MYSQL_SDB_ERROR","Erro ao selecionar base de dados");
define("SQLAPI_MYSQL_NOQUERY","Consulta nula(em branco)");
define("SQLAPI_MYSQL_EOD","Fim da consulta");
/*
end bootstrap
*/

class SQLAPI_MYSQL {
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
	 * $cnx
	 * @value
	 */
	var	$cnx = "";

	/* 
	 * set_access
	 * @method
	 */

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
	/*
	 * _start
	 * @method
	 */
	function _start() {
		if(is_a($this,__CLASS__)) {
			$cnx = @mysql_connect($this->dbhost,$this->dbuser,$this->dbpwd);
			if(!$cnx) {
				$this->error = SQLAPI_MYSQL_CNX_ERROR;
				return false;
			} elseif(!@mysql_select_db($this->dbname,$cnx)) {
				$this->error = SQLAPI_MYSQL_SDB_ERROR;
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
				/*
					BugFix #0001: erro quando query nao retorna resultados
				 */
				if(eregi("^select",$statement)) {
					$rest = 1;
				} else {
					$rest = 2;
				}
				$res = mysql_query($statement,$this->cnx);
				if($rest == 1) {
					if(!is_resource($res)) {
						$this->error = "Query exec error. MySQL said: " . mysql_error();
						return false;
					} else {
						return $res;
					}
				} else {
					if($res) {
						return true;
					} else {
						$this->error = "Query exec error. MySQL said: " . mysql_error();
						return false;
					}
				}
			} else {
				$this->error = SQLAPI_MYSQL_NOQUERY;
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
			@mysql_close($this->cnx);
		} 			
	}
}

class SQLAPI_RES_MYSQL {
	/*
	 * $error
	 * @value
	 */
	var	$error = "";
	/*
	 * get_statement_info()
	 * @method
	 */
	function get_statement_info($qp = "") {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				return @mysql_fetch_field($qp);
			} else {
				$this->error = SQLAPI_MYSQL_INVALID_QPOINTER;
				return false;
			}
		} else {
			return false;
		}
	}

	/*
	 * get_info()
	 * @method
	 */
	function get_info($qp = "") {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				return @mysql_info($qp);
			} else {
				$this->error = SQLAPI_MYSQL_INVALID_QPOINTER;
				return false;
			}
		} else {
			return false;
		}
	}
	
	/*
	 * _numrows()
	 * @method
	 */
	function _numrows($qp = "") {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				$num = @mysql_num_rows($qp);
				return $num;
			} else {
				$this->error = SQLAPI_MYSQL_INVALID_QPOINTER;
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
	function _affected_rows($qp = "") {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				return @mysql_affected_rows($qp);
			} else {
				$this->error = SQLAPI_MYSQL_INVALID_QPOINTER;
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
	function _fetch_row($qp = "") {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				$row = @mysql_fetch_row($qp);
				if(!$row) {	
					$this->error = SQLAPI_MYSQL_EOD;
					return false;
				} else {
					return $row;
				}
			} else {
				$this->error = SQLAPI_MYSQL_INVALID_QPOINTER;
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
	function _fetch_assoc($qp = "") {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				$row = @mysql_fetch_assoc($qp);
				if(!$row) {
					$this->error = SQLAPI_MYSQL_EOD;
					return false;
				} else {
					return $row;
				}
			} else {
				$this->error = SQLAPI_MYSQL_INVALID_QPOINTER;
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
	function _fetch_object($qp = "") {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				$row = @mysql_fetch_object($qp);
				if(!$row) {
					$this->error = SQLAPI_MYSQL_EOD;
					return false;
				} else {
					return $row;
				}
			} else {
				$this->error = SQLAPI_MYSQL_INVALID_QPOINTER;
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
	function _fetch_xml($qp = "") {
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
	function _freeresult($qp = "") {
		if(is_a($this,__CLASS__)) {
			if(is_resource($qp)) {
				@mysql_free_result($qp);
			}
		}
	}
}

?>
