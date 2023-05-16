<?php
class Ccc_Practice_Adminhtml_PracticeController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Practice'))
             ->_title($this->__('Manage Practices'));
        $this->loadLayout();
        
        $this->renderLayout();
    }
}