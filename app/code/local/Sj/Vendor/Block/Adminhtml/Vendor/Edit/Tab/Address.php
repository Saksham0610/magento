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

        $fieldset->addField('city', 'text', array(
            'label' => Mage::helper('vendor')->__('City'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[city]',
        ));

        $fieldset->addField('state', 'text', array(
            'label' => Mage::helper('vendor')->__('State'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[state]',
        ));

        $fieldset->addField('country', 'text', array(
            'label' => Mage::helper('vendor')->__('Country'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[country]',
        ));

        $fieldset->addField('zip', 'text', array(
            'label' => Mage::helper('vendor')->__('Zip'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[zip]',
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