<?php
class Saksham_Saksham_Model_Form extends Mage_Eav_Model_Form
{
    protected $_moduleName = 'saksham';
    protected $_entityTypeCode = 'saksham';

    protected function _getFormAttributeCollection()
    {
        return parent::_getFormAttributeCollection()
            ->addFieldToFilter('attribute_code', array('neq' => 'created_at'));
    }
}
