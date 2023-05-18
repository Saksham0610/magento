<?php
class Saksham_Saksham_Adminhtml_SakshamController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Saksham'))
             ->_title($this->__('Saksham'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('saksham/adminhtml_saksham'));
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('entity_id');
        $model = Mage::getModel('saksham/saksham')->load($id);
        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('saksham_data', $model);
            $this->loadLayout();
            $this->_setActiveMenu('saksham/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            $this->_addContent($this->getLayout()->createBlock(' saksham/adminhtml_saksham_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('saksham/adminhtml_saksham_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('saksham')->__('Data does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try {
            $sakshamModel = Mage::getModel('saksham/saksham');
            $sakshamData = $this->getRequest()->getPost('saksham');
            $sakshamModel->setData($sakshamData)
                ->setId($this->getRequest()->getParam('id'));

            if ($sakshamModel->entity_id == NULL) {
                $sakshamModel->created_at = date("y-m-d H:i:s");
            } else {
                $sakshamModel->updated_at = date("y-m-d H:i:s");
            }

            $sakshamModel->save();

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('saksham')->__('Data was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(true);

            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $sakshamModel->getId()));
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
        $sakshamIds = $this->getRequest()->getParam('entity_id');
        if(!is_array($sakshamIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('saksham/saksham')->__('Please select data(s).'));
        } else {
            try {
                $model = Mage::getModel('saksham/saksham');
                foreach ($sakshamIds as $sakshamId) {
                    $model->load($sakshamId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('saksham')->__(
                    'Total of %d record(s) were deleted.', count($sakshamIds)
                )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
}