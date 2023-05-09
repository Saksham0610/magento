<?php
class Ccc_Product_Block_Adminhtml_Product_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('productAdminhtmlProductGrid');
        $this->setDefaultSort('product_id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('product/product')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('product_id', array(
            'header'    => Mage::helper('product')->__('Product Id'),
            'align'     => 'left',
            'index'     => 'product_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('product')->__('Name'),
            'align'     => 'left',
            'index'     => 'name'
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('product')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku'
        ));

        $this->addColumn('cost', array(
            'header'    => Mage::helper('product')->__('Cost'),
            'align'     => 'left',
            'index'     => 'cost'
        ));

        $this->addColumn('price', array(
            'header'    => Mage::helper('product')->__('Price'),
            'align'     => 'left',
            'index'     => 'price'
        ));

        $this->addColumn('quantity', array(
            'header'    => Mage::helper('product')->__('Quantity'),
            'align'     => 'left',
            'index'     => 'quantity'
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('product')->__('Status'),
            'align'     => 'left',
            'index'     => 'status'
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('product')->__('Created At'),
            'align'     => 'left',
            'index'     => 'created_at'
        ));

        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('product')->__('Updated At'),
            'align'     => 'left',
            'index'     => 'updated_at'
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('product_id');
        $this->getMassactionBlock()->setFormFieldName('product_id');
         
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('product/product')->__('Delete'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('product/product')->__('Are you sure?')
        ));
         
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('product_id' => $row->getId()));
    }
}