<?php
class Ccc_Product_Model_Form extends Mage_Eav_Model_Form
{
    protected $_moduleName = 'product';
    protected $_entityTypeCode = 'product';

    protected function _getFormAttributeCollection()
    {
        return parent::_getFormAttributeCollection()
            ->addFieldToFilter('attribute_code', array('neq' => 'created_at'));
    }
}
