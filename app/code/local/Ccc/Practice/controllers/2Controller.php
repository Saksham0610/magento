<?php
class Ccc_Practice_2Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $model = Mage::getModel('practice/practice');
        $collection = $model->getCollection();

        $writeConnection = $collection->getConnection('core_write');
        $query = "INSERT INTO `product` (`base_id`) VALUES ('1')";
        $writeConnection->query($query);


        print_r();
    }
}