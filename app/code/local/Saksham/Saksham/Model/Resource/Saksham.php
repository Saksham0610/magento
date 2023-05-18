<?php
class Saksham_Saksham_Model_Resource_Saksham extends Mage_Core_Model_Resource_Db_Abstract
{
    function _construct()
    {
        $this->_init('saksham/saksham', 'entity_id');
    }
}