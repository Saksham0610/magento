<?php
class Saksham_Collection_Model_Resource_Collection extends Mage_Core_Model_Resource_Db_Abstract
{
    function _construct()
    {
        $this->_init('collection/collection', 'collection_id');
    }
}