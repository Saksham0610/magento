<?php
class Ccc_Vendor_Model_Resource_Vendor_Address extends Mage_Core_Model_Resource_Db_Abstract
{
    function _construct()
    {
        $this->_init('vendor/vendor_address', 'address_id');
    }
}