<?php
class Saksham_Saksham_Model_Resource_Saksham_Collection extends Mage_Catalog_Model_Resource_Collection_Abstract
{
	public function __construct()
	{
		$this->setEntity('saksham');
		parent::__construct();	
	}
}