<?php
class Saksham_Eavmgmt_Model_Resource_Eavmgmt_Collection extends Mage_Eav_Model_Resource_Entity_Attribute_Collection
{
    protected function _construct()
    {
        $this->_init('eavmgmt/eavmgmt');
    }
}