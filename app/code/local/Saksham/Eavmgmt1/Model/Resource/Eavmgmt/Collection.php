<?php
class Saksham_Eavmgmt_Model_Resource_Eavmgmt_Collection extends Mage_Catalog_Model_Resource_Collection_Abstract
{
	public function __construct()
	{
		$this->setEntity('eavmgmt');
		parent::__construct();	
	}
}