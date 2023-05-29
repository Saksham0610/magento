<?php

class Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt_Grid extends Mage_Eav_Block_Adminhtml_Attribute_Grid_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('eavmgmtAdminhtmlEavmgmtGrid');
        $this->setDefaultSort('attribute_id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('eavmgmt/eavmgmt')->getCollection();
        $collection->getSelect()
                    ->joinLeft(
                        array('eet'=> 'eav_entity_type'),
                        "eet.entity_type_id = main_table.entity_type_id"
                    );
                    // ->joinRight(
                    //     array('additional_table' => $collection->getTable('catalog/eav_attribute')),
                    //     'additional_table.attribute_id = main_table.attribute_id'
                    // );
        $this->setCollection($collection);
        Mage::register('entity_type', $collection->getData());
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();
        $this->addColumn('attribute_id', array(
            'header'    => Mage::helper('eavmgmt')->__('Index'),
            'align'     => 'left',
            'index'     => 'attribute_id',
        ));

        parent::_prepareColumns();
        $this->addColumnAfter('is_visible', array(
            'header'=>Mage::helper('catalog')->__('Visible'),
            'sortable'=>true,
            'index'=>'is_visible_on_front',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('catalog')->__('Yes'),
                '0' => Mage::helper('catalog')->__('No'),
            ),
            'align' => 'center',
        ), 'frontend_label');

        $this->addColumnAfter('is_global', array(
            'header'=>Mage::helper('catalog')->__('Scope'),
            'sortable'=>true,
            'index'=>'is_global',
            'type' => 'options',
            'options' => array(
                Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE =>Mage::helper('catalog')->__('Store View'),
                Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE =>Mage::helper('catalog')->__('Website'),
                Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL =>Mage::helper('catalog')->__('Global'),
            ),
            'align' => 'center',
        ), 'is_visible');

        $this->addColumn('is_searchable', array(
            'header'=>Mage::helper('catalog')->__('Searchable'),
            'sortable'=>true,
            'index'=>'is_searchable',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('catalog')->__('Yes'),
                '0' => Mage::helper('catalog')->__('No'),
            ),
            'align' => 'center',
        ), 'is_user_defined');

        $this->addColumnAfter('is_filterable', array(
            'header'=>Mage::helper('catalog')->__('Use in Layered Navigation'),
            'sortable'=>true,
            'index'=>'is_filterable',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('catalog')->__('Filterable (with results)'),
                '2' => Mage::helper('catalog')->__('Filterable (no results)'),
                '0' => Mage::helper('catalog')->__('No'),
            ),
            'align' => 'center',
        ), 'is_searchable');

        $this->addColumnAfter('is_comparable', array(
            'header'=>Mage::helper('catalog')->__('Comparable'),
            'sortable'=>true,
            'index'=>'is_comparable',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('catalog')->__('Yes'),
                '0' => Mage::helper('catalog')->__('No'),
            ),
            'align' => 'center',
        ), 'is_filterable');

        $this->addColumnAfter('entity_type_code',
            array(
                'header' => Mage::helper('catalog')->__('Entity Type'),
                'width'  => '50px',
                'index'  => 'entity_type_code',
            ), 'frontend_label');

        $this->addColumn('action',
            array(
                'header'    => Mage::helper('eavmgmt')->__('Action'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('eavmgmt')->__('Options'),
                        'url'     => array(
                            'base'=>'*/*/edit',
                            'params'=>array('store'=>$this->getRequest()->getParam('attribute_id'))
                        ),
                        'field'   => 'attribute_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
        ));

        return $this;
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('attribute_id');
        $this->getMassactionBlock()->setFormFieldName('attribute_id');

        $this->getMassactionBlock()->addItem('export', array(
        'label'=> Mage::helper('eavmgmt')->__('Export'),
        'url'  => $this->getUrl('*/*/massExportCsvAttribute', array('' => '')),
        'confirm' => Mage::helper('eavmgmt')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('export_options', array(
        'label'=> Mage::helper('eavmgmt')->__('Export Options'),
        'url'  => $this->getUrl('*/*/massExportCsvAttributeOption', array('' => '')),
        'confirm' => Mage::helper('eavmgmt')->__('Are you sure?')
        ));
         
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('attribute_id' => $row->getId()));
    }
   
}