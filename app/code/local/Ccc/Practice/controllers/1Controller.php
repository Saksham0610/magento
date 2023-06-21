<?php
class Ccc_Practice_1Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";

        $collection = Mage::getModel('practice/practice')->getCollection();
        // echo $collection->getSelect()->where('small_id = 8');
        echo $collection->getSelect()
            ->joinRight(
                array('p' => 'product'),
                "p.product_id = main_table.product_id"
            );
        print_r($collection->getData());
        print_r($collection->toArray());
    }
}