<?php
class Ccc_Practice_Block_Adminhtml_Fourth_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('practiceAdminhtmlPracticeGrid');
        $this->setDefaultSort('sku');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('entity_id')
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('image')
            ->addAttributeToSelect('thumbnail')
            ->addAttributeToSelect('small_image');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('product')->__('Entity Id'),
            'align'     => 'left',
            'index'     => 'entity_id'
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('product')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku',
        ));

        $this->addColumn('image', array(
            'header'    => Mage::helper('product')->__('Image'),
            'align'     => 'left',
            'index'     => 'image'
        ));

        $this->addColumn('thumbnail', array(
            'header'    => Mage::helper('product')->__('Thumbnail'),
            'align'     => 'left',
            'index'     => 'thumbnail'
        ));

        $this->addColumn('small_image', array(
            'header'    => Mage::helper('product')->__('Small Image'),
            'align'     => 'left',
            'index'     => 'small_image'
        ));

        return parent::_prepareColumns();
    }
}