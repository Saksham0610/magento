<?php
class Ccc_Practice_9Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $model = Mage::getModel('practice/practice');
        $row = new Varien_Object();
        print_r(get_class_methods($row));

        
    }
}