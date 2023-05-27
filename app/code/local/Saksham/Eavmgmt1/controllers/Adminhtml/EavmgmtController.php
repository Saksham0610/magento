<?php 

class Saksham_Eavmgmt_Adminhtml_EavmgmtController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction(){
		$this->loadLayout();
		$this->_setActiveMenu('eavmgmt');
		$this->_title('Eavmgmt Grid');
		$this->_addContent($this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt'));
		$this->renderLayout();
	}

	protected function _initEavmgmt()
    {
        $this->_title($this->__('Eavmgmt'))
            ->_title($this->__('Manage Eavmgmts'));

        $eavmgmtId = (int) $this->getRequest()->getParam('id');
        $eavmgmt   = Mage::getModel('eavmgmt/eavmgmt')
            ->setStoreId($this->getRequest()->getParam('store', 0))
            ->load($eavmgmtId);

        if (!$eavmgmtId) {
            if ($setId = (int) $this->getRequest()->getParam('set')) {
                $eavmgmt->setAttributeSetId($setId);
            }
        }

        Mage::register('current_eavmgmt', $eavmgmt);
        Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));
        return $eavmgmt;
    }

	public function newAction(){
		$this->_forward('edit');
	}

	public function editAction(){ 
		$eavmgmtId = (int) $this->getRequest()->getParam('id');
        $eavmgmt   = $this->_initEavmgmt();
        
        if ($eavmgmtId && !$eavmgmt->getId()) {
            $this->_getSession()->addError(Mage::helper('eavmgmt')->__('This eavmgmt no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }

        $this->_title($eavmgmt->getName());

        $this->loadLayout();

        $this->_setActiveMenu('eavmgmt/eavmgmt');

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->renderLayout();
	}

	public function saveAction()
    {
        try {
            $setId = (int) $this->getRequest()->getParam('set');
            $eavmgmtData = $this->getRequest()->getPost('account');            
            $eavmgmt = Mage::getSingleton('eavmgmt/eavmgmt');
            $eavmgmt->setAttributeSetId($setId);

            if ($eavmgmtId = $this->getRequest()->getParam('id')) {
                if (!$eavmgmt->load($eavmgmtId)) {
                    throw new Exception("No Row Found");
                }
                Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
            }
            
            $eavmgmt->addData($eavmgmtData);

            $eavmgmt->save();

            Mage::getSingleton('core/session')->addSuccess("eavmgmt data added.");
            $this->_redirect('*/*/');

        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    public function deleteAction()
    {
        try {

            $eavmgmtModel = Mage::getModel('eavmgmt/eavmgmt');

            if (!($eavmgmtId = (int) $this->getRequest()->getParam('id')))
                throw new Exception('Id not found');

            if (!$eavmgmtModel->load($eavmgmtId)) {
                throw new Exception('eavmgmt does not exist');
            }

            if (!$eavmgmtModel->delete()) {
                throw new Exception('Error in delete record', 1);
            }

            Mage::getSingleton('core/session')->addSuccess($this->__('The eavmgmt has been deleted.'));

        } catch (Exception $e) {
            Mage::logException($e);
            $Mage::getSingleton('core/session')->addError($e->getMessage());
        }
        
        $this->_redirect('*/*/');
    }
}