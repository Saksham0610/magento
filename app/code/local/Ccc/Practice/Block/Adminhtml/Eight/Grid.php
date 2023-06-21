<?php
class Ccc_Practice_Block_Adminhtml_Eight_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('practiceAdminhtmlPracticeGrid');
        $this->setDefaultSort('name');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('sales/order_item_collection');
        $collection->getSelect()
            ->columns(array(
                'product_id' => 'product_id',
                'sku' => 'sku',
                'sold_quantity' => 'SUM(qty_ordered)'
            ))
            ->group('product_id');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('product_id', array(
            'header'    => Mage::helper('product')->__('Product Id'),
            'align'     => 'left',
            'index'     => 'product_id'
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('product')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku'
        ));

        $this->addColumn('sold_quantity', array(
            'header'    => Mage::helper('product')->__('Sold Quantity'),
            'align'     => 'left',
            'index'     => 'sold_quantity'
        ));

        return parent::_prepareColumns();
    }
}