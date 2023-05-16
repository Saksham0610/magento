<?php
class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Address extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('address_form',array('legend'=>Mage::helper('salesman')->__('Salesman Address Information')));

        $fieldset->addField('address', 'text', array(
            'label' => Mage::helper('salesman')->__('Address'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[address]',
        ));

        $fieldset->addField('city', 'text', array(
            'label' => Mage::helper('salesman')->__('City'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[city]',
        ));

        $fieldset->addField('state', 'text', array(
            'label' => Mage::helper('salesman')->__('State'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[state]',
        ));

        $fieldset->addField('country', 'text', array(
            'label' => Mage::helper('salesman')->__('Country'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[country]',
        ));

        $fieldset->addField('zip', 'text', array(
            'label' => Mage::helper('salesman')->__('Zip'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'address[zip]',
        ));

        if ( Mage::getSingleton('adminhtml/session')->getsalesmanData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getsalesmanData());
            Mage::getSingleton('adminhtml/session')->setsalesmanData(null);
        } elseif ( Mage::registry('address_data') ) {
            $form->setValues(Mage::registry('address_data')->getData());
        }

        return parent::_prepareForm();
    }
}