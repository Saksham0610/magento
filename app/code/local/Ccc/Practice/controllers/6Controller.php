<?php
class Ccc_Practice_6Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $model = Mage::getModel('practice/practice');
        $collection = Mage::getModel('practice/practice')->getCollection();
        $readConnection = $collection->getConnection('core_read');

        $query = "SELECT * FROM `product` WHERE `sku`='1400'";

        $select = $readConnection->select()
            ->from('product', array('sku'))
            ->where('sku = 1400');

        $results = $readConnection->fetchAll($query);
        print_r($results);
        $objects = array();
        foreach ($results as $row) {
            $object = new Varien_Object($row);
            $objects[] = $object;
        }

        print_r($objects);

        
    }
}