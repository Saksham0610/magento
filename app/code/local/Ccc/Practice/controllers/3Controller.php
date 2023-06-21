<?php
class Ccc_Practice_3Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $model = Mage::getModel('practice/practice');
        $collection = Mage::getModel('practice/practice')->getCollection();
        $model->setData(['sku'=>'1'])->save();
        
    }
}