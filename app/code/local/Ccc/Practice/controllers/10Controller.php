<?php
class Ccc_Practice_10Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        print_r(get_class_methods('Mage_Core_Block_Template'));
        print_r(get_class_methods('Mage_Core_Model_Layout'));

        
    }
}