<?php
class Sj_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('vendor_form',array('legend'=>Mage::helper('vendor')->__('Vendor Information')));
        $fieldset->addField('first_name', 'text', array(
            'label' => Mage::helper('vendor')->__('First Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'vendor[first_name]',
        ));

        $fieldset->addField('last_name', 'text', array(
            'label' => Mage::helper('vendor')->__('Last Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'vendor[last_name]',
        ));

        $fieldset->addField('email', 'text', array(
            'label' => Mage::helper('vendor')->__('Email'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'vendor[email]',
        ));

        $fieldset->addField('gender', 'select', array(
            'label' => Mage::helper('vendor')->__('Gender'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'vendor[gender]',
            'options' => array(
                '1' => Mage::helper('vendor')->__('Male'),
                '2' => Mage::helper('vendor')->__('Female'),
            ),
        ));

        $fieldset->addField('mobile', 'text', array(
            'label' => Mage::helper('vendor')->__('Mobile'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'vendor[mobile]',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('vendor')->__('Status'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'vendor[status]',
            'options' => array(
                '1' => Mage::helper('vendor')->__('Active'),
                '2' => Mage::helper('vendor')->__('Inactive'),
            ),
        ));

        $fieldset->addField('company', 'text', array(
            'label' => Mage::helper('vendor')->__('Company'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'vendor[company]',
        ));

        

        if ( Mage::getSingleton('adminhtml/session')->getvendorData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getvendorData());
            Mage::getSingleton('adminhtml/session')->setvendorData(null);
        } elseif ( Mage::registry('vendor_data') ) {
            $form->setValues(Mage::registry('vendor_data')->getData());
        }return parent::_prepareForm();
    }
}