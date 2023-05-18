<?php
class Saksham_Saksham_Block_Adminhtml_Saksham_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('saksham_form',array('legend'=>Mage::helper('saksham')->__('Information')));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('saksham')->__('Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'saksham[name]',
        ));

        if ( Mage::getSingleton('adminhtml/session')->getsakshamData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getsakshamData());
            Mage::getSingleton('adminhtml/session')->setsakshamData(null);
        } elseif ( Mage::registry('saksham_data') ) {
            $form->setValues(Mage::registry('saksham_data')->getData());
        }return parent::_prepareForm();
    }
}