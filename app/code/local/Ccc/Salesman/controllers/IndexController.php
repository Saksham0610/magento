<?php
require_once(Mage::getModuleDir('controllers','Ccc_Product').DS.'IndexController.php');
class Ccc_Salesman_IndexController extends Ccc_Product_IndexController
{
    public function indexAction()
    {
        echo 123;
    }
}