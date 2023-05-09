<?php
class Ccc_Category_Model_Form extends Mage_Eav_Model_Form
{
    protected $_moduleName = 'category';
    protected $_entityTypeCode = 'category';

    protected function _getFormAttributeCollection()
    {
        return parent::_getFormAttributeCollection()
            ->addFieldToFilter('attribute_code', array('neq' => 'created_at'));
    }
}
