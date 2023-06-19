<?php
class Sj_Vendor_Model_Resource_Vendor extends Mage_Core_Model_Resource_Db_Abstract
{
    function _construct()
    {
        $this->_init('vendor/vendor', 'vendor_id');
    }
}