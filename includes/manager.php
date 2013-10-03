<?php
/**
 * @package Abricos
 * @subpackage Elemcat
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @author Alexander Kuzmin <roosit@abricos.org>
 */

require_once 'classes.php';

class ElemcatManager extends Ab_ModuleManager {
	
	/**
	 * 
	 * @var ElemcatModule
	 */
	public $module = null;
	
	/**
	 * @var ElemcatManager
	 */
	public static $instance = null;
	
	/**
	 * Конфиг
	 * @var ElemcatConfig
	 */
	public $config = null;
	
	private $_isRoleDisabled = false;
	
	public function __construct($module){
		parent::__construct($module);

		ElemcatManager::$instance = $this;

		$this->config = new ElemcatConfig(Abricos::$config['module']['elemcat']);
	}
	
	/**
	 * Отключение ролей. Используется в процессе инсталляции.
	 */
	public function RoleDisable(){
		$this->_isRoleDisabled = true;
	}
	
	public function IsAdminRole(){
		if ($this->_isRoleDisabled){ return true; }
		return $this->IsRoleEnable(ElemcatAction::ADMIN);
	}
	
	public function IsWriteRole(){
		if ($this->IsAdminRole()){ return true; }
		return $this->IsRoleEnable(ElemcatAction::WRITE);
	}
	
	public function IsViewRole(){
		if ($this->IsWriteRole()){ return true; }
		return $this->IsRoleEnable(ElemcatAction::VIEW);
	}

	public function AJAX($d){
		switch($d->do){
			case "initdata": return $this->InitDataToAJAX();
		}
		return null;
	}
	
	public function InitDataToAJAX(){
		if (!$this->IsViewRole()){ return null; }
		
		$ret = new stdClass();

		return $ret;
	}
		
}

?>