<?php
class Ccc_Product_Model_Resource_Product extends Mage_Core_Model_Resource_Db_Abstract
{
    function _construct()
    {
        $this->_init('product/product', 'product_id');
    }
}