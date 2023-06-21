<?php
class Ccc_Practice_Block_Adminhtml_Third_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
        $collection = Mage::getModel('eav/entity_attribute')->getCollection();
        $collection->getSelect()
            ->joinLeft(
                array('option_count_table' => $collection->getTable('eav/attribute_option')),
                'option_count_table.attribute_id = main_table.attribute_id',
                array('option_count' => 'COUNT(option_count_table.option_id)')
            )
            ->group('main_table.attribute_id')
            ->having('COUNT(option_count_table.option_id) > 1', 1);

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('attribute_id', array(
            'header'    => Mage::helper('product')->__('Attribute Id'),
            'align'     => 'left',
            'index'     => 'attribute_id'
        ));

        $this->addColumn('attribute_code', array(
            'header'    => Mage::helper('product')->__('Attribute Code'),
            'align'     => 'left',
            'index'     => 'attribute_code'
        ));

        $this->addColumn('option_count', array(
            'header'    => Mage::helper('product')->__('Option Count'),
            'align'     => 'left',
            'index'     => 'option_count'
        ));

        return parent::_prepareColumns();
    }
}