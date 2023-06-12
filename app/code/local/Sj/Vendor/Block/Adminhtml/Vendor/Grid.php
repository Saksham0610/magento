<?php
class Sj_Vendor_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('vendorAdminhtmlVendorGrid');
        $this->setDefaultSort('vendor_id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('vendor/vendor')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('vendor_id', array(
            'header'    => Mage::helper('vendor')->__('Vendor Id'),
            'align'     => 'left',
            'index'     => 'vendor_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('vendor')->__('Name'),
            'align'     => 'left',
            'index'     => 'name'
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('vendor')->__('Email'),
            'align'     => 'left',
            'index'     => 'email'
        ));

        $this->addColumn('mobile', array(
            'header'    => Mage::helper('vendor')->__('Mobile'),
            'align'     => 'left',
            'index'     => 'mobile'
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('vendor')->__('Status'),
            'align'     => 'left',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                '1' => $this->__('Active'),
                '0' => $this->__('Not Active'),
            ),
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('vendor')->__('Created At'),
            'align'     => 'left',
            'index'     => 'created_at'
        ));

        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('vendor')->__('Updated At'),
            'align'     => 'left',
            'index'     => 'updated_at'
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('vendor_id');
        $this->getMassactionBlock()->setFormFieldName('vendor_id');
         
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('vendor')->__('Delete'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('vendor')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('vendor/vendor')->getStatuses();
        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label'      => $this->__('Change Status'),
            'url'        => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'visibility' => array(
                    'name'   => 'status',
                    'type'   => 'select',
                    'class'  => 'required-entry',
                    'label'  => $this->__('Status'),
                    'values' => $statuses,
                )
            )
        ));

         
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('vendor_id' => $row->getId()));
    }
}