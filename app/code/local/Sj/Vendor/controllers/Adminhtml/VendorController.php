<?php
class Sj_Vendor_Adminhtml_VendorController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction() {
        $this->_title($this->__('Vendor'))
             ->_title($this->__('Manage Vendors'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('vendor/adminhtml_vendor'));
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('vendor_id');
        $model = Mage::getModel('vendor/vendor')->load($id);
        $addressModel = Mage::getModel('vendor/vendor_address')->load($id, 'vendor_id');
        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('vendor_data', $model);
            Mage::register('address_data', $addressModel);
            $this->loadLayout();
            $this->_setActiveMenu('vendor/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            $this->_addContent($this->getLayout()->createBlock(' vendor/adminhtml_vendor_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('vendor/adminhtml_vendor_edit_tabs'));
            $this->renderLayout();

        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Vendor does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction() {
        try {
            $vendorModel = Mage::getModel('vendor/vendor');
            $vendorData = $this->getRequest()->getPost('vendor');
            $addressData = $this->getRequest()->getPost('address');
            $vendorModel->setData($vendorData)
                ->setId($this->getRequest()->getParam('id'));
            // echo "<pre>"; print_r($vendorModel); die();
            if ($vendorModel->vendor_id == NULL) {
                $vendorModel->created_at = date("y-m-d H:i:s");
            } else {
                $vendorModel->updated_at = date("y-m-d H:i:s");
            }

            $vendorModel->save();
            if (!($id = $this->getRequest()->getParam('id'))) {
                $addressModel = Mage::getModel('vendor/vendor_address');
            } else {
                $addressModel = Mage::getModel('vendor/vendor_address')->load($id, 'vendor_id');
            }

            $addressModel->setData(array_merge($addressModel->getData(), $addressData))->addData(['vendor_id'=>$vendorModel->getId()])->save();

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('vendor')->__('Vendor was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(true);

            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $vendorModel->getId()));
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

    public function massDeleteAction() {
        $vendorIds = $this->getRequest()->getParam('vendor_id');
        if(!is_array($vendorIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Please select vendor(s).'));
        } else {
            try {
                $model = Mage::getModel('vendor/vendor');
                foreach ($vendorIds as $vendorId) {
                    $model->load($vendorId)->delete();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('vendor')->__(
                    'Total of %d record(s) were deleted.', count($vendorIds)
                )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

    public function massStatusAction() {
        $vendorIds = $this->getRequest()->getParam('vendor_id');
        $status = $this->getRequest()->getParam('status');
        if ($status != 1) {
            $status = 0;
        }

        if (!is_array($vendorIds)) {
            $this->_getSession()->addError($this->__('Please select vendor(s).'));
        } else {
            try {
                foreach ($vendorIds as $vendorId) {
                    $vendor = Mage::getModel('vendor/vendor')->load($vendorId);
                    $vendor->setStatus($status)->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d vendor(s) have been updated.', count($vendorIds)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
}