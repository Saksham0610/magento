<?php 
class Saksham_Eavmgmt_Model_Resource_Eavmgmt extends Mage_Eav_Model_Entity_Abstract
{
	const ENTITY = 'eavmgmt';
	public function __construct()
	{
		$this->setType(self::ENTITY)
			 ->setConnection('core_read', 'core_write');
	   parent::__construct();
    }
}