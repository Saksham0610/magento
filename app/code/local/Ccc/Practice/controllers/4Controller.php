<?php
class Ccc_Practice_4Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $model = Mage::getModel('practice/practice');
        $collection = Mage::getModel('practice/practice')->getCollection();
        $writeConnection = $collection->getConnection('core_write');
        $data = array(
            array(
                'sku' => '1',
            ),
            array(
                'sku' => '3',
            ),
        );
        $writeConnection->insertMultiple('product', $data);

    }
}