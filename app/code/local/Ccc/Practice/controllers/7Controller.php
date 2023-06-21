<?php
class Ccc_Practice_7Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";

        print_r(Mage::getModel('practice/practice')->getCollection()->getConnection());
        print_r(get_class_methods('Zend_Db_Adapter_Mysqli'));
        print_r(get_class_methods('Zend_Db_Adapter_Abstract'));

        
    }
}