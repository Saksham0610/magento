<?php
class Ccc_Practice_Model_Resource_Practice extends Mage_Core_Model_Resource_Db_Abstract
{
    function _construct()
    {
        $this->_init('practice/practice', 'product_id');
    }
}