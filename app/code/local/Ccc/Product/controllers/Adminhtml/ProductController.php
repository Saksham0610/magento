<?php
class Ccc_Product_Adminhtml_ProductController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Product'))
             ->_title($this->__('Manage Products'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('product/adminhtml_product'));
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('product_id');
        $model = Mage::getModel('product/product')->load($id);
        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('product_data', $model);
            $this->loadLayout();
            $this->_setActiveMenu('product/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            $this->_addContent($this->getLayout()->createBlock(' product/adminhtml_product_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('product/adminhtml_product_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('product')->__('Product does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try {
            $productModel = Mage::getModel('product/product');
            $productData = $this->getRequest()->getPost('product');
            $productModel->setData($productData)
                ->setId($this->getRequest()->getParam('id'));

            if ($productModel->product_id == NULL) {
                $productModel->created_at = date("y-m-d H:i:s");
            } else {
                $productModel->updated_at = date("y-m-d H:i:s");
            }

            $productModel->save();

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('product')->__('Product was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(true);

            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $productModel->getId()));
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            return;
        }
    }

    public function massDeleteAction()
    {
        $productIds = $this->getRequest()->getParam('product_id');
        if(!is_array($productIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('product/product')->__('Please select product(s).'));
        } else {
            try {
                $model = Mage::getModel('product/product');
                foreach ($productIds as $productId) {
                    $model->load($productId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('product/product')->__(
                    'Total of %d record(s) were deleted.', count($productIds)
                )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
}