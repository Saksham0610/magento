<?php
class Ccc_Practice_8Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $model = Mage::getModel('practice/practice');
        $resource = new Ccc_Practice_Model_Resource_Practice();
        print_r(get_class_methods($resource));

        
    }
}