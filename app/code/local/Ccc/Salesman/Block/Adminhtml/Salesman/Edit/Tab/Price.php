<?php
class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Price extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('salesmanAdminhtmlSalesmanGrid');
        $this->setDefaultSort('salesman_id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('salesman/salesman_price')->getCollection();
        $collection->getSelect()
            ->joinRight(
                array('p' => 'product'),
                "p.product_id = main_table.product_id"
            );
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('product_id', array(
            'header'    => Mage::helper('salesman')->__('Product Id'),
            'align'     => 'left',
            'index'     => 'product_id'
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('salesman')->__('Name'),
            'align'     => 'left',
            'index'     => 'name'
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('salesman')->__('Sku'),
            'align'     => 'left',
            'index'     => 'sku'
        ));

        $this->addColumn('cost', array(
            'header'    => Mage::helper('salesman')->__('Cost'),
            'align'     => 'left',
            'index'     => 'cost'
        ));

        $this->addColumn('price', array(
            'header'    => Mage::helper('salesman')->__('Price'),
            'align'     => 'left',
            'index'     => 'price'
        ));

        $this->addColumn('salesman_price', array(
            'header'    => Mage::helper('salesman')->__('Salesman Price'),
            'align'     => 'left',
            'index'     => 'salesman_price',
            'type'      => 'input',
            'editable' => true,
            'edit_only' => true,
            'renderer' => 'salesman/adminhtml_salesman_edit_tab_price_renderer_price',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('entity_id');

        $this->getMassactionBlock()->addItem('save', array(
        'label'=> Mage::helper('salesman')->__('Save'),
        'url'  => $this->getUrl('*/*/massPriceSave', array('' => '')),
        'confirm' => Mage::helper('salesman')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('salesman')->__('Delete'),
        'url'  => $this->getUrl('*/*/massPriceDelete', array('' => '')),
        'confirm' => Mage::helper('salesman')->__('Are you sure?')
        ));
         
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('salesman_id' => $row->getId()));
    }
}