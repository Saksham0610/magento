<?php
class Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt_Exportoption extends Mage_Eav_Block_Adminhtml_Attribute_Grid_Abstract
{
     protected function _prepareColumns()
    {
        $this->addColumn('index', array(
            'header' => Mage::helper('eavmgmt')->__('Index'),
            'index'  => 'entity_id',
            'renderer'=> 'Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt_Csv_Number'
        ));

        $this->addColumn('attribute_id', array(
            'header'=>Mage::helper('eav')->__('Entity Type'),
            'sortable'=>true,
            'index'=>'attribute_id',
            'renderer'=> 'Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt_Csv_EntityType'
        ));

        $this->addColumn('attribute_code', array(
            'header'=>Mage::helper('eav')->__('Attribute Code'),
            'sortable'=>true,
            'index'=>'attribute_code'
        ));

        $this->addColumn('frontend_label', array(
            'header'=>Mage::helper('eav')->__('Attribute Name'),
            'sortable'=>true,
            'index'=>'frontend_label'
        ));

        $this->addColumn('option_id', array(
            'header'=>Mage::helper('eav')->__('Option Id'),
            'sortable'=>true,
            'index'=>'option_id'
        ));

         $this->addColumn('value', array(
            'header'=>Mage::helper('eav')->__('Option Name'),
            'sortable'=>true,
            'index'=>'value',
            'renderer'=> 'Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt_Csv_EntityOption'
        ));

         $this->addColumn('sort_order', array(
            'header'=>Mage::helper('eav')->__('Option Sort Order'),
            'sortable'=>true,
            'index'=>'sort_order'
        ));

        return $this;
    }
}