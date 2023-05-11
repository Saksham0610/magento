<?php
class Ccc_Salesman_Model_Form extends Mage_Eav_Model_Form
{
    protected $_moduleName = 'salesman';
    protected $_entityTypeCode = 'salesman';

    protected function _getFormAttributeCollection()
    {
        return parent::_getFormAttributeCollection()
            ->addFieldToFilter('attribute_code', array('neq' => 'created_at'));
    }
}
