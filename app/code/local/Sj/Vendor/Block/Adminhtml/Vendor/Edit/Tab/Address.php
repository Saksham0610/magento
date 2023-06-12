<?php
class Sj_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Address extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('address_form',array('legend'=>Mage::helper('vendor')->__('Vendor Address Information')));

        $fieldset->addField('address', 'text', array(
            'label' => Mage::helper('vendor')->__('Address'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[address]',
        ));

        $fieldset->addField('postal_code', 'text', array(
            'label' => Mage::helper('vendor')->__('Postal Code'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[postal_code]',
        ));

        $fieldset->addField('city', 'text', array(
            'label' => Mage::helper('vendor')->__('City'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[city]',
        ));

        $fieldset->addField('state', 'select', array(
            'label' => Mage::helper('vendor')->__('State'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[state]',
            'values'    => Mage::getModel('directory/region')->getResourceCollection()
                            ->addCountryFilter($countryId)
                            ->load()
                            ->toOptionArray()
        ));

        $fieldset->addField('country', 'select', array(
            'label' => Mage::helper('vendor')->__('Country'),
            'class' => 'required-entry',
            'values' => Mage::getModel('vendor/vendor')->getCountryOptions(),
            'required' => true,
            'name' => 'address[country]',
            'values'    => Mage::getModel('directory/country')->getResourceCollection()
                            ->loadByStore()
                            ->toOptionArray(),
            'onchange'  => 'updateStateOptions(this.value)',
        ));

        if ( Mage::getSingleton('adminhtml/session')->getvendorData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getvendorData());
            Mage::getSingleton('adminhtml/session')->setvendorData(null);
        } elseif ( Mage::registry('address_data') ) {
            $form->setValues(Mage::registry('address_data')->getData());
        }

        return parent::_prepareForm();
    }
}