<?php 
class Saksham_Saksham_Adminhtml_SakshamController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction(){
		$this->loadLayout();
		$this->_setActiveMenu('saksham');
		$this->_title('Saksham Grid');
		$this->_addContent($this->getLayout()->createBlock('saksham/adminhtml_saksham'));
		$this->renderLayout();
	}

	protected function _initSaksham()
    {
        $this->_title($this->__('saksham'))
            ->_title($this->__('Manage'));

        $sakshamId = (int) $this->getRequest()->getParam('id');
        $saksham   = Mage::getModel('saksham/saksham')
            ->setStoreId($this->getRequest()->getParam('store', 0))
            ->load($sakshamId);

        if (!$sakshamId) {
            if ($setId = (int) $this->getRequest()->getParam('set')) {
                $saksham->setAttributeSetId($setId);
            }
        }

        Mage::register('current_saksham', $saksham);
        Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));
        return $saksham;
    }

	public function newAction(){
		$this->_forward('edit');
	}

	public function editAction(){ 
		$sakshamId = (int) $this->getRequest()->getParam('id');
        $saksham   = $this->_initSaksham();
        
        if ($sakshamId && !$saksham->getId()) {
            $this->_getSession()->addError(Mage::helper('saksham')->__('This data no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }

        $this->_title($saksham->getName());

        $this->loadLayout();

        $this->_setActiveMenu('saksham/saksham');

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->renderLayout();
	}

	public function saveAction()
    {
        try {
            $setId = (int) $this->getRequest()->getParam('set');
            $sakshamData = $this->getRequest()->getPost('account');            
            $saksham = Mage::getSingleton('saksham/saksham');
            $saksham->setAttributeSetId($setId);

            if ($sakshamId = $this->getRequest()->getParam('id')) {
                if (!$saksham->load($sakshamId)) {
                    throw new Exception("No Row Found");
                }
                Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
            }
            
            $saksham->addData($sakshamData);

            $saksham->save();

            Mage::getSingleton('core/session')->addSuccess("data added.");
            $this->_redirect('*/*/');

        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    public function deleteAction()
    {
        try {

            $sakshamModel = Mage::getModel('saksham/saksham');

            if (!($sakshamId = (int) $this->getRequest()->getParam('id')))
                throw new Exception('Id not found');

            if (!$sakshamModel->load($sakshamId)) {
                throw new Exception('data does not exist');
            }

            if (!$sakshamModel->delete()) {
                throw new Exception('Error in delete record', 1);
            }

            Mage::getSingleton('core/session')->addSuccess($this->__('The data has been deleted.'));

        } catch (Exception $e) {
            Mage::logException($e);
            $Mage::getSingleton('core/session')->addError($e->getMessage());
        }
        
        $this->_redirect('*/*/');
    }
}