<?php 
/**
 * @package Abricos
 * @subpackage Elemcat
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @author Alexander Kuzmin <roosit@abricos.org>
 */

require_once 'dbquery.php';

class ElemcatConfig {

	/**
	 * @var ElemcatConfig
	 */
	public static $instance;

	public function __construct($cfg){
		ElemcatConfig::$instance = $this;

		if (empty($cfg)){ $cfg = array(); }

		/*
		 if (isset($cfg['subscribeSendLimit'])){
		$this->subscribeSendLimit = intval($cfg['subscribeSendLimit']);
		}
		/**/
	}
}

?>