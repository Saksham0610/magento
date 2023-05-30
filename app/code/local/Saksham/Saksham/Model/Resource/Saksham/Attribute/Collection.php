<?php
class Saksham_Saksham_Model_Resource_Saksham_Attribute_Collection extends Mage_Eav_Model_Resource_Entity_Attribute_Collection
{
	protected function _initSelect()
    {
        $this->getSelect()->from(array('main_table' => $this->getResource()->getMainTable()))
            ->where('main_table.entity_type_id=?', Mage::getModel('eav/entity')->setType(Saksham_Saksham_Model_Resource_Saksham::ENTITY)->getTypeId())
            ->join(
                array('additional_table' => $this->getTable('saksham/eav_attribute')),
                'additional_table.attribute_id = main_table.attribute_id'
            );
        return $this;
    }

    public function setEntityTypeFilter()
    {
        return $this;
    }
}