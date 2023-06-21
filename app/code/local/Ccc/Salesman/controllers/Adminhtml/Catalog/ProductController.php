<?php
require_once(Mage::getModuleDir('controllers','Mage_Adminhtml').DS.'Catalog\ProductController.php');
class Ccc_Salesman_Adminhtml_Catalog_ProductController extends Mage_Adminhtml_Catalog_ProductController
{
	public function newAction()
	{
		echo 111;
		die;
	}
}