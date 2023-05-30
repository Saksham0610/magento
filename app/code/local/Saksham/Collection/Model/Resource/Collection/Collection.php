<?php
class Saksham_Collection_Model_Resource_Collection_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('collection/collection');
    }
}