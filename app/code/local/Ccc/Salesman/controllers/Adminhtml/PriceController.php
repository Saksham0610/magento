<?php
class Ccc_Salesman_Adminhtml_PriceController extends Mage_Adminhtml_Controller_Action
{
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost('salesman_price')) {
            try {
                print_r($data);
                die;
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('salesman')->__('Input field data saved.'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('An error occurred while saving input field data.'));
            }
        }

        $this->_redirect('*/*/edit', ['salesman_id' => 1]);
    }

}