<?php
class Ccc_Salesman_Adminhtml_SalesmanController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Salesman'))
             ->_title($this->__('Manage Salesmans'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('salesman/adminhtml_salesman'));
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('salesman_id');
        $model = Mage::getModel('salesman/salesman')->load($id);
        $addressModel = Mage::getModel('salesman/salesman_address')->load($id, 'salesman_id');  

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('salesman_data', $model);
            Mage::register('address_data', $addressModel);
            $this->loadLayout();
            $this->_setActiveMenu('salesman/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            $this->_addContent($this->getLayout()->createBlock(' salesman/adminhtml_salesman_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('salesman/adminhtml_salesman_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Salesman does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try {
            $salesmanModel = Mage::getModel('salesman/salesman');
            $salesmanData = $this->getRequest()->getPost('salesman');
            $addressData = $this->getRequest()->getPost('address');
            $salesmanModel->setData($salesmanData)
                ->setId($this->getRequest()->getParam('id'));

            if ($salesmanModel->salesman_id == NULL) {
                $salesmanModel->created_at = date("y-m-d H:i:s");
            } else {
                $salesmanModel->updated_at = date("y-m-d H:i:s");
            }

            $salesmanModel->save();

            if (!($id = $this->getRequest()->getParam('id'))) {
                $addressModel = Mage::getModel('salesman/salesman_address');
            } else {
                $addressModel = Mage::getModel('salesman/salesman_address')->load($id, 'salesman_id');
            }

            $addressModel->setData(array_merge($addressModel->getData(), $addressData))->addData(['salesman_id'=>$salesmanModel->getId()])->save();
            $salesmanModel->addData(['address_id' => $addressModel->address_id])->save();

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('salesman')->__('Salesman was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(true);

            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $salesmanModel->getId()));
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
        $salesmanIds = $this->getRequest()->getParam('salesman_id');
        if(!is_array($salesmanIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Please select salesman(s).'));
        } else {
            try {
                $model = Mage::getModel('salesman/salesman');
                foreach ($salesmanIds as $salesmanId) {
                    $model->load($salesmanId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('salesman/salesman')->__(
                    'Total of %d record(s) were deleted.', count($salesmanIds)
                )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massPriceSaveAction()
    {
        $data = $this->getRequest()->getPost();
        echo "<pre>";
        print_r($data);
        die;
    }

    public function massPriceDeleteAction()
    {
        $entityIds = $this->getRequest()->getParam('entity_id');
        if(!is_array($entityIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Please select salesman(s).'));
        } else {
            try {
                $model = Mage::getModel('salesman/salesman_price');
                foreach ($entityIds as $entityId) {
                    $model->load($entityId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('salesman')->__(
                    'Total of %d record(s) were deleted.', count($entityIds)
                )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/edit', ['salesman_id' => $this->getRequest()->getParam('salesman_id')]);
    }

}