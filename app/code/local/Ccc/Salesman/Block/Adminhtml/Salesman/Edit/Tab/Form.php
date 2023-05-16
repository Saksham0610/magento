<?php
class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('salesman_form',array('legend'=>Mage::helper('salesman')->__('salesman Information')));
        $fieldset->addField('first_name', 'text', array(
            'label' => Mage::helper('salesman')->__('First Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'salesman[first_name]',
        ));

        $fieldset->addField('last_name', 'text', array(
            'label' => Mage::helper('salesman')->__('Last Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'salesman[last_name]',
        ));

        $fieldset->addField('email', 'text', array(
            'label' => Mage::helper('salesman')->__('Email'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'salesman[email]',
        ));

        $fieldset->addField('gender', 'select', array(
            'label' => Mage::helper('salesman')->__('Gender'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'salesman[gender]',
            'options' => array(
                '1' => Mage::helper('salesman')->__('Male'),
                '2' => Mage::helper('salesman')->__('Female'),
            ),
        ));

        $fieldset->addField('mobile', 'text', array(
            'label' => Mage::helper('salesman')->__('Mobile'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'salesman[mobile]',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('salesman')->__('Status'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'salesman[status]',
            'options' => array(
                '1' => Mage::helper('salesman')->__('Active'),
                '2' => Mage::helper('salesman')->__('Inactive'),
            ),
        ));

        $fieldset->addField('company', 'text', array(
            'label' => Mage::helper('salesman')->__('Company'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'salesman[company]',
        ));

        if ( Mage::getSingleton('adminhtml/session')->getsalesmanData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getsalesmanData());
            Mage::getSingleton('adminhtml/session')->setsalesmanData(null);
        } elseif ( Mage::registry('salesman_data') ) {
            $form->setValues(Mage::registry('salesman_data')->getData());
        }

        return parent::_prepareForm();
    }
}