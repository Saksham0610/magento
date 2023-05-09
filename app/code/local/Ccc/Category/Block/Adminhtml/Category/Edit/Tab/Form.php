<?php
class Ccc_Category_Block_Adminhtml_Category_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('category_form',array('legend'=>Mage::helper('category')->__('Category Information')));
        $fieldset->addField('parent_id', 'text', array(
            'label' => Mage::helper('category')->__('Parent Id'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'category[parent_id]',
        ));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('category')->__('Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'category[name]',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('category')->__('Status'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'category[status]',
            'options' => array(
                '1' => Mage::helper('category')->__('Active'),
                '2' => Mage::helper('category')->__('Inactive'),
            ),
        ));

        $fieldset->addField('description', 'text', array(
            'label' => Mage::helper('category')->__('Description'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'category[description]',
        ));


        if ( Mage::getSingleton('adminhtml/session')->getcategoryData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getcategoryData());
            Mage::getSingleton('adminhtml/session')->setcategoryData(null);
        } elseif ( Mage::registry('category_data') ) {
            $form->setValues(Mage::registry('category_data')->getData());
        }return parent::_prepareForm();
    }
}