<?php
class Saksham_Saksham_Model_Attribute extends Mage_Eav_Model_Attribute
{
    const MODULE_NAME = 'Saksham_Saksham';
    protected $_eventObject = 'attribute';

    protected function _construct()
    {
        $this->_init('saksham/attribute');
    }
}