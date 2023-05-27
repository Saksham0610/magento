<?php

class Saksham_Eavmgmt_Model_Attribute extends Mage_Eav_Model_Attribute
{
    const MODULE_NAME = 'Saksham_Eavmgmtt';
    protected $_eventObject = 'attribute';

    protected function _construct()
    {
        $this->_init('eavmgmt/attribute');
    }
}