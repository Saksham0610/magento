<?php
class Ccc_Product_Block_Adminhtml_Product_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('product_form',array('legend'=>Mage::helper('product')->__('Product Information')));
        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('product')->__('Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'product[name]',
        ));

        $fieldset->addField('sku', 'text', array(
            'label' => Mage::helper('product')->__('SKU'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'product[sku]',
        ));

        $fieldset->addField('cost', 'text', array(
            'label' => Mage::helper('product')->__('Cost'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'product[cost]',
        ));

        $fieldset->addField('price', 'text', array(
            'label' => Mage::helper('product')->__('Price'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'product[price]',
        ));

        $fieldset->addField('quantity', 'text', array(
            'label' => Mage::helper('product')->__('Quantity'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'product[quantity]',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('product')->__('Status'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'product[status]',
            'options' => array(
                '1' => Mage::helper('product')->__('Active'),
                '2' => Mage::helper('product')->__('Inactive'),
            ),
        ));

        if ( Mage::getSingleton('adminhtml/session')->getproductData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getproductData());
            Mage::getSingleton('adminhtml/session')->setproductData(null);
        } elseif ( Mage::registry('product_data') ) {
            $form->setValues(Mage::registry('product_data')->getData());
        }return parent::_prepareForm();
    }
}