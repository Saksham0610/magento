<?php

class Ccc_Salesman_Model_Product extends Mage_Catalog_Model_Product
{
	function __construct()
	{
		echo "<pre>";
		print_r($this);
		die;
		parent::__construct();
	}
}