<?php
class Ccc_Practice_5Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $model = Mage::getModel('practice/practice');
        $collection = Mage::getModel('practice/practice')->getCollection();

        echo $collection->getSelect()->where('small_id = 8');

        print_r($collection->getItems());
        print_r($collection->toArray());
    }
}