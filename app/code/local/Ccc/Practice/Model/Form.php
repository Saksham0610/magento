<?php
class Ccc_Practice_Model_Form extends Mage_Eav_Model_Form
{
    protected $_moduleName = 'practice';
    protected $_entityTypeCode = 'practice';

    protected function _getFormAttributeCollection()
    {
        return parent::_getFormAttributeCollection()
            ->addFieldToFilter('attribute_code', array('neq' => 'created_at'));
    }
}
