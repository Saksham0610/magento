<?php 
class Saksham_Saksham_Model_Resource_Saksham extends Mage_Eav_Model_Entity_Abstract
{
	const ENTITY = 'saksham';
	public function __construct()
	{
		$this->setType(self::ENTITY)
			 ->setConnection('core_read', 'core_write');
	   parent::__construct();
    }
}