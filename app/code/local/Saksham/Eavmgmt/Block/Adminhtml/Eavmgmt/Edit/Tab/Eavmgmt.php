<?php
class Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt_Edit_Tab_Eavmgmt extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('eavmgmt_form',array('legend'=>Mage::helper('eavmgmt')->__('Upload file')));
        $fieldset->addField('file', 'file', array(
            'label' => Mage::helper('eavmgmt')->__('Upload Csv File'),
            'required' => true,
            'name' => 'import_options',
        ));

        return parent::_prepareForm();
    }
}