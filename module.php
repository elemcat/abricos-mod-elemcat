<?php
/**
 * @package Abricos
 * @subpackage Elemcat
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @author Alexander Kuzmin <roosit@abricos.org>
 */

class ElemcatModule extends Ab_Module {
	
	/**
	 * @var ElemcatModule
	 */
	public static $instance = null;
	
	private $_manager = null;
	
	public function ElemcatModule(){
		// версия модуля
		$this->version = "0.1";

		// имя модуля 
		$this->name = "elemcat";
		$this->takelink = "elemcat";

		$this->permission = new ElemcatPermission($this);
		
		ElemcatModule::$instance = $this;
	}
	
	/**
	 * @return ElemcatManager
	 */
	public function GetManager(){
		if (is_null($this->_manager)){
			require_once 'includes/manager.php';
			$this->_manager = new ElemcatManager($this);
		}
		return $this->_manager;
	}
	
	public function GetContentName(){
		return "";
	}

}

class ElemcatAction {
	const VIEW	= 10;
	const WRITE	= 30;
	const ADMIN	= 50;
}

class ElemcatPermission extends Ab_UserPermission {

	public function ElemcatPermission(ElemcatModule $module){
		
		$defRoles = array(
			new Ab_UserRole(ElemcatAction::VIEW, Ab_UserGroup::GUEST),
			new Ab_UserRole(ElemcatAction::VIEW, Ab_UserGroup::REGISTERED),
			new Ab_UserRole(ElemcatAction::VIEW, Ab_UserGroup::ADMIN),

			new Ab_UserRole(ElemcatAction::WRITE, Ab_UserGroup::REGISTERED),
			new Ab_UserRole(ElemcatAction::WRITE, Ab_UserGroup::ADMIN),
				
			new Ab_UserRole(ElemcatAction::ADMIN, Ab_UserGroup::ADMIN),
		);
		
		parent::__construct($module, $defRoles);
	}

	public function GetRoles(){
		return array(
			ElemcatAction::VIEW => $this->CheckAction(ElemcatAction::VIEW),
			ElemcatAction::WRITE => $this->CheckAction(ElemcatAction::WRITE),
			ElemcatAction::ADMIN => $this->CheckAction(ElemcatAction::ADMIN)
		);
	}
}
Abricos::ModuleRegister(new ElemcatModule());


?>