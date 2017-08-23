<?php
/**
 * Proteções de tipos de dados - funções
 *
 */
class EurekaDataProtection {
	private $pver = null;
	public function __construct() {

	}
	public function getInt($arg = null,$default = null) {
		if(is_null($arg)) return $default;
		$arg = trim($arg);
		if(strlen($arg)<=0) return $default;

		if(preg_match("/^(\d+)/",$arg,$match)) {
			return $match[1];
		} else {
			return $default;
		}
	}
	public function detectSQLInjection($arg = null, $argname = null) {
		if(is_null($arg)) return false; /* provavelmente nada, é nada */
		$arg = trim($arg);
		if(
			preg_match("/\d+=\d+/",$arg) ||
			preg_match("/UNION ALL/i",$arg) ||
			preg_match("/0x[0-9ABCDEF]/i",$arg) ||
			preg_match("/WAITFOR DELAY\)/i",$arg) ||
			preg_match("/\/\*.*?\*\//",$arg) ||
			preg_match("/CHR\(|CASE WHEN|ELSE .*? END|CHAR\(|\'\)|SELECT |UPDATE |DELETE |TRUNCATE |CREATE [TEMP TABLE|TABLE|VIEW|INDEX|USER]|HEX|UNHEX|ALTER  [TABLE|INDEX|USER|VIEW|DATABASE]|DATABASE\(|(information_){0,1}.*?schema|(GROUP|ORDER) BY|LIMIT \d+|HAVING |LIKE |BETWEEN |CAST\(|DROP [TABLE|VIEW|INDEX|USER|SCHEMA]/i",$arg)
		) {
			$fp = fopen('./log/dataprotection.log','a');
			$logstr = sprintf("[%s] %s %s=%s\n",date("d/m/Y H:i:s"),$_SERVER['REMOTE_ADDR'],$argname,$arg);
			fputs($fp,$logstr);
			//echo $logstr;
			fclose($fp);
			Header("HTTP/1.0 403 Forbidden");
			exit;
		}
	}
	public function parseRequest() {
		switch(strtolower($_SERVER['REQUEST_METHOD'])) {
			case 'post':
				$var = $_POST;
				break;
			case 'get':
				$var = $_GET;
				break;
			default:
				$var = $_REQUEST;
		}
		foreach($var as $k => $v) {
			if(!is_array($v)){
				$this->detectSQLInjection($v,$k);
			}
		}
	}
}