<?
/* SQLAPI 
 * Versao: 0.1
 * Autor: Anselmo Daniel Adams <adams@cafeautomatic.com.br>
 * Copyright CafeAutomatic 2004
 */

//----------------------------------------------------------------
//bootstrap code
//----------------------------------------------------------------
//os detection
if(preg_match('/WIN/', PHP_OS)) {
	$isW32 = true;
} else {
	$isW32 = false;
}
$inc_append = dirname(__FILE__);
$inc_path = ini_get('include_path');

//gerando o include_path correto para a inclusão dos drivers
if($isW32) {
	$inc_path .= ";" . $inc_append . ";" . $inc_append . "\\drivers";
} else {
	$inc_path .= ":" .  $inc_append . ":" . $inc_append . "/drivers";
}
ini_set('include_path',$inc_path);
require_once("sqlapi_defines.php");
unset($inc_path);
if($isW32) {
	$d_dir = dir($inc_append . "\\drivers");
} else {
	$d_dir = dir($inc_append . "/drivers");
}

while($r=$d_dir->read()) {
	if(preg_match('/^[^\.]/',$r)) {
		require_once($r);
	}
}
$drv_str = "";
foreach($SQLAPI_DRVARR as $v) {
	$drv_str .= " $v";
}
$drv_str = ltrim($drv_str);
define("SQLAPI_DRIVERS",$drv_str);
$d_dir->close();
unset($inc_append);
unset($d_dir);

//----------------------------------------------------------------
//Classe de resultados(base)
//----------------------------------------------------------------
class SQLAPI_RES {
	/*
	 * $error
	 * @var
	 */
	
	var	$error = "";
	
	/*
	 * $statement
	 * @var
	 */
	
	var	$statement = "";
	
	/*
	 * $qpointer
	 * @resource
	 */
	
	var	$qpointer = "";
	
	/*
	 * $stinfo
	 * @var
	 */
	
	var	$stinfo = "";
	
	/*
	 * $rowscount
	 * @var
	 */
	
	var	$rowscount = "";
	
	/*
	 * $driver
	 * @var
	 */
	 
	var	$driver = "";
	
	/*
	 * $rtype
	 * @var
	 */
	 
	var	$rtype = false;
	
	/*
	 * $handler
	 * @var
	 */

	var	$handler = "";
	
	/*
	 * Construtor
	 * @method
	 */
	
	function SQLAPI_RES($driver = "",$query_pointer = "",$statement = "") {
		if(is_a($this,__CLASS__)) {
			if(!empty($driver)) {
				if(!preg_match('/'.$driver.'/',SQLAPI_DRIVERS)) {
					$this->error = SQLAPI_ERROR_UNKNOW_DRIVER;
					return false;	
				} else {
					$this->driver = strtolower($driver);
				}
			} else {
				$this->driver = SQLAPI_DEFAULT_DRIVER;
			}
			if(!is_resource($query_pointer)) {
				$this->error = SQLAPI_ERROR_INVALID_QUERY_POINTER;
				return false;
			} else {
				$this->qpointer = $query_pointer;
			}
			if(empty($statement)) {
				$this->error = SQLAPI_ERROR_NO_STATEMENT;
				return false;
			} else {
				if(preg_match('/^select/',$statement)) {
					$this->rtype = 1;
				} else {
					$this->rtype = 2;
				}
			$this->statement = $statement;
			}
			//iniciando driver
			$driver_name = "SQLAPI_RES_" . strtoupper($this->driver);
			if(!class_exists($driver_name)) {
				$this->error = SQLAPI_ERROR_DRIVER_NOT_FOUND;
			} else {
				$this->handler =  new $driver_name;
			}
			if($this->rtype == 1) {
				$this->stinfo = $this->handler->get_statement_info($this->qpointer);
				$this->rowscount = $this->handler->_numrows($this->qpointer);
			} else {
				$this->stinfo = $this->handler->get_info($this->qpointer);
				$this->rowscount = $this->handler->_affected_rows($this->qpointer);
			}
			return true;
		} else {
			return false;
		}
	}

	/*
	 * fetch_row()
	 * @method
	 */
	function fetch_row() {
		if(is_a($this,__CLASS__)) {
			if($this->rtype == 1) {
				$res = $this->handler->_fetch_row($this->qpointer);
				if(!$res) {
					$this->error = $this->handler->error;
					return false;
				} else {
					return $res;
				}
			} else {
				$this->error = SQLAPI_ERROR_RES_NON_SELECT;
				return false;
			}
		} else {
			return false;
		}
	}

	/*
	 * fetchrow()
	 * @method
	 */

	function fetchrow() {
		if(is_a($this,__CLASS__)) {
			if($this->rtype == 1) {
				$res = $this->handler->_fetch_row($this->qpointer);
				if(!$res) {
					$this->error = $this->handler->error;
					return false;
				} else {
					return $res;
				}
			} else {
				$this->error = SQLAPI_ERROR_RES_NON_SELECT;
				return false;
			}
		} else {
			return false;
		}
	}

	/*
	 * fetch_assoc()
	 * @method
	 */

	function fetch_assoc() {
		if(is_a($this,__CLASS__)) {
			if($this->rtype == 1) {
				$res = $this->handler->_fetch_assoc($this->qpointer);
				if(!$res) {
					$this->error = $this->handler->error;
					return false;
				} else {
					return $res;
				}
			} else {
				$this->error = SQLAPI_ERROR_RES_NON_SELECT;
				return false;
			}
		} else {
			return false;
		}
	}

	/*
	 * fetch_object()
	 * @method
	 */

	function fetch_object() {
		if(is_a($this,__CLASS__)) {
			if($this->rtype == 1) {
				$res = $this->handler->_fetch_object($this->qpointer);
				if(!$res) {
					$this->error = $this->handler->error;
					return false;
				} else {
					return $res;
				}
			} else {
				$this->error = SQLAPI_ERROR_RES_NON_SELECT;
				return false;
			}
		} else {
			return false;
		}
	}

	/*
	 * fetchobject()
	 * @method
	 */

	function fetchobject() {
		if(is_a($this,__CLASS__)) {
			if($this->rtype == 1) {
				$res = $this->handler->_fetch_object($this->qpointer);
				if(!$res) {
					$this->error = $this->handler->error;
					return false;
				} else {
					return $res;
				}
			} else {
				$this->error = SQLAPI_ERROR_RES_NON_SELECT;
				return false;
			}
		} else {
			return false;
		}
	}

	/*
	 * fetchobj()
	 * @method
	 */

	function fetchobj() {
		if(is_a($this,__CLASS__)) {
			if($this->rtype == 1) {
				$res = $this->handler->_fetch_object($this->qpointer);
				if(!$res) {
					$this->error = $this->handler->error;
					return false;
				} else {
					return $res;
				}
			} else {
				$this->error = SQLAPI_ERROR_RES_NON_SELECT;
				return false;
			}
		} else {
			return false;
		}
	}

	/*
	 * fetch_xml()
	 * @method
	 */

	function fetch_xml() {
		if(is_a($this,__CLASS__)) {
			if($this->rtype == 1) {
				$res = $this->handler->_fetch_xml($this->qpointer,$this->stinfo);
				if(!$res) {
					$this->error = $this->handler->error;
					return false;
				} else {
					return $res;
				}
			} else {
				$this->error = SQLAPI_ERROR_RES_NON_SELECT;
				return false;
			}
		} else {
			return false;
		}
	}

	/*
	 * num_rows()
	 * @method
	 */

	function num_rows() {
		if(is_a($this,__CLASS__)) {
			return $this->rowscount;
		} else {
			return false;
		}
	}

	/*
	 * numrows()
	 * @method
	 */

	function numrows() {
		if(is_a($this,__CLASS__)) {
			return $this->rowscount;
		} else {
			return false;
		}
	}

	/*
	 * affected_rows()
	 * @method
	 */

	function affected_rows() {
		if(is_a($this,__CLASS__)) {
			return $this->rowscount;
		} else {
			return false;
		}
	}

	/*
	 * error()
	 * @method
	 */
	function error() {
		if(is_a($this,__CLASS__)) {
			return $this->error;
		} else {
			return false;
		}
	}

	/* 
	 * get_stinfo()
	 * @method
	 */
	 
	function get_stinfo() {
		if(is_a($this,__CLASS__)) {
			if($this->rtype == 1) {
				return $this->stinfo;
			} else {
				$this->error = SQLAPI_ERROR_RES_NON_SELECT;
				return false;
			}
		} else {
			return false;
		}
	}
	/*
	 * destructor
	 */
	function __sleep() {
		if(is_a($this,__CLASS__)) {
			$this->handler->_freeresult($this->qpointer);
		}
	}
	/*
	 * End of madness
	 */
}


class SQLAPI {
	/*
	 * $error
	 * @var
	 */

	var	$error = "";
	
	/*
	 * $handler
	 * @var
	 */
	
	var	$handler = "";

	/*
	 * $dbuser
	 * @var
	 */

	var	$dbuser = "";

	/*
	 * $dbpwd
	 * @var
	 */

	var	$dbpwd = "";

	/*
	 * $dbhost
	 * @var
	 */

	var	$dbhost = "";

	/*
	 * $dbport
	 * @var
	 */

	var	$dbport = "";

	/*
	 * $dbname
	 * @var
	 */

	var	$dbname = "";

	/*
	 * $driver
	 * @var
	 */

	var	$driver = "";

	/*
	 * $driver
	 * @var
	 */

	var	$isOk = false;

	function SQLAPI($driver = "",$dbhost = "",$dbuser = "",$dbpwd = "",$dbname = "",$dbport = "") {
		if(is_a($this,__CLASS__)) {
			if(!empty($driver)) {
				if(preg_match('/'.$drive.'/',SQLAPI_DRIVERS)) {
					$this->driver = strtolower($driver);
				} else {
					$this->error = SQLAPI_ERROR_UNKNOW_DRIVER;
					return false;
				}
			} else {
				$this->driver = SQLAPI_DEFAULT_DRIVER;
			}
			if(!empty($dbuser)) {
				$this->dbuser = $dbuser;
			}
			if(!empty($dbpwd)) {
				$this->dbpwd = $dbpwd;
			}
			if(!empty($dbname)) {
				$this->dbname = $dbname;
			}
			if(!empty($dbhost)) {
				$this->dbhost = $dbhost;
			}
			if(!empty($dbport)) {
				$this->dbport = $dbport;
			}
			//carregando o driver
			$driver_name = "SQLAPI_" . strtoupper($this->driver);
			if(!class_exists($driver_name)) {
				$this->error = SQLAPI_ERROR_DRIVER_NOT_FOUND;
				return false;
			} else {
				$this->handler = new $driver_name;
			}
			$this->handler->set_access($this->dbuser,$this->dbpwd,$this->dbhost,$this->dbname,$this->dbport);
			if(!$this->handler->_start()) {
				$this->error = $this->handler->error;
				return false;
			} 
			$this->isOk = true;
			return true;
		} else {
			return false;
		}
	}
	/*
	 * execute()
	 * @method
	 */
	function execute($query) {
		if(is_a($this,__CLASS__)) {
			if(!empty($query)) {
				$res_t = $this->handler->_execute($query);
				
				if(!is_resource($res_t)) {
					$this->error = $this->handler->error;
					return false;
				} else {
					$res_obj = new SQLAPI_RES($this->driver,$res_t,$query);
					if(is_object($res_obj)) {
						return $res_obj;
					} else {
						return false;
					}
				}
			}
		} else {
			return false;
		}
	}
	/*
	 * dothis()
	 * @method
	 */
	function dothis($query ="") {
		if(is_a($this,__CLASS__)) {
			if(!empty($query)) {
				$ret =  $this->handler->_execute($query);
				if(!$ret) {
					$this->error = $this->handler->error;
					return false;
				} else {
					return true;
				}
			}
		} else {
			return false;
		}
	}
	/*
	 * get_info()
	 * @method
	 */
	function get_info() {
		if(is_a($this,__CLASS__)) {
			$info =  $this->handler->_get_info();
			if(!$info) {
				$this->error = $this->handler->error;
				return false;
			} else {
				return $info;
			}
		} else {
			return false;
		}
	}
	/*
	 * destructor
	 */
	function __sleep() {
		if(is_a($this,__CLASS__)) {
			$this->handler->_close();
		}
	}
	/*
	 * End of Madness
	 */
}
/*
 * EOF
 */
?>
