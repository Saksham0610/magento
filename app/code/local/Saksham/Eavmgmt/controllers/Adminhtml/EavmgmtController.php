<?php

class Saksham_Eavmgmt_Adminhtml_EavmgmtController extends Mage_Adminhtml_Controller_Action
{
    
    function indexAction()
    {
        $this->_title($this->__('Eavmgmt'))
             ->_title($this->__('Manage Eavmgmts'));
        $this->loadLayout();
        $this->_setActiveMenu('eavmgmt/manage');
        $this->_addContent($this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt'));
        $this->renderLayout();
    }

   
    public function editAction(){
        $id = $this->getRequest()->getParam('eavmgmt_id');
        $model = Mage::getModel('eavmgmt/eavmgmt')->load($id);
        $modelAddress = Mage::getModel('eavmgmt/eavmgmt_address')->load($id, 'eavmgmt_id');

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('current_eavmgmt', $model);
            Mage::register('eavmgmt_address', $modelAddress);
                 
            $this->loadLayout();
            $this->_setActiveMenu('eavmgmt/items');
             
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Eavmgmt Manager'), Mage::helper('adminhtml')->__('Eavmgmt Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Eavmgmt News'), Mage::helper('adminhtml')->__('Eavmgmt News'));
             
            $this->_addContent($this->getLayout()->createBlock(' eavmgmt/adminhtml_eavmgmt_edit'))
            ->_addLeft($this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('eavmgmt')->__('Eavmgmt does not exist'));
            $this->_redirect('*/*/');
        }

    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            echo'<pre>';
            $model = Mage::getModel('eavmgmt/eavmgmt');
            $eavmgmtId = $this->getRequest()->getParam('eavmgmt_id');
            $model->setData($data['eavmgmt'])->setId($eavmgmtId);
            try {
                if ($model->eavmgmt_id == NULL) {
                    $model->created_at = now();
                } else {
                    $model->updated_at = now();
                }
                if ($model->save()) {
                    if ( $eavmgmtId) {
                        $modelAddress = Mage::getModel('eavmgmt/eavmgmt_address')->load($eavmgmtId,'eavmgmt_id');
                    }else{
                        $modelAddress = Mage::getModel('eavmgmt/eavmgmt_address');
                    }
                    
                    $modelAddress->eavmgmt_id = $model->getId();
                    $modelAddress->setData(array_merge($modelAddress->getData(),$data['address']));
                    $modelAddress->save();
                    
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('eavmgmt')->__('Eavmgmt was successfully saved'));
                    Mage::getSingleton('adminhtml/session')->setFormData(false);
                     
                    
                }
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('eavmgmt_id' => $model->getId()));
                    return;
                }

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('eavmgmt_id' => $this->getRequest()->getParam('eavmgmt_id')));
                return;
            }
        }
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('eavmgmt')->__('Unable to find item to save'));
            $this->_redirect('*/*/');
    }
    

    public function deleteAction() 
    {
        if( $this->getRequest()->getParam('eavmgmt_id') > 0 ) {
            try {
                $model = Mage::getModel('eavmgmt/eavmgmt');
                 
                $model->setId($this->getRequest()->getParam('eavmgmt_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Eavmgmt was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('eavmgmt_id' => $this->getRequest()->getParam('eavmgmt_id')));
            }
        }
        $this->_redirect('*/*/');
    }


    public function massDeleteAction()
    {
        $eavmgmtId = $this->getRequest()->getParam('eavmgmt_id');
        if(!is_array($eavmgmtId)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('eavmgmt/eavmgmt')->__('Please select tax(es).'));
        } else {
            try {
                $model = Mage::getModel('eavmgmt/eavmgmt');
                foreach ($eavmgmtId as $id) {
                    $model->load($id)->delete();
                }
                
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('eavmgmt/eavmgmt')->__('Total of %d record(s) were deleted.', count($eavmgmtId))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
         
        $this->_redirect('*/*/index');
    }

    public function exportCsvAttributeAction()
    {
        $fileName = 'attribute_'.date('ymd_His').'.csv';
        $content = $this->_getCsvContent();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportCsvAttributeOptionAction()
    {
        $fileName = 'attributeoptions_'.date('ymd_His').'.csv';
        $content = $this->_getCsvContentOption();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    protected function _getCsvContent()
    {
        $collection = Mage::getResourceModel('eavmgmt/eavmgmt_collection');
        $content = '';
        $headers = array(
            'index' => 'Index',
            'attribute_id' => 'Attribute Id',
            'attribute_code' => 'Attribute Code',
            'frontend_label' => 'Attribute Name',
            'frontend_input' => 'Input Type',
            'backend_type' => 'Backend Type',
            'source_model' => 'Source Model'
        );
        $content .= '"' . implode('","', $headers) . '"' . "\n";
        $i = 0;
        foreach ($collection as $item) {
            $i += 1; 
            $row = array(
                $i,
                $item->attribute_id,
                $item->attribute_code,
                $item->frontend_label,
                $item->frontend_input,
                $item->backend_type,
                $item->source_model
            );
            $row = array_map(function($value) {
                return '"' . str_replace('"', '""', $value) . '"';
            }, $row);
            $content .= implode(',', $row) . "\n";
        }
        return $content;
    }

    protected function _getCsvContentOption()
    {
        $collection = Mage::getModel('eavmgmt/eavmgmt')->getOption();
        $content = '';
        $headers = array(
            'index' => 'Index',
            'attribute_id' => 'Attribute Id',
            'attribute_code' => 'Attribute Code',
            'frontend_label' => 'Attribute Name',
            'option_id' => 'Option Id',
            'value' => 'Option Name',
            'sort_order' => 'Option Sort Order'
        );
        $content .= '"' . implode('","', $headers) . '"' . "\n";
        $i = 0;
        foreach ($collection as $item) {
            $i += 1; 
            $row = array(
                $i,
                $item->attribute_id,
                $item->attribute_code,
                $item->frontend_label,
                $item->frontend_input,
                $item->backend_type,
                $item->source_model
            );
            $row = array_map(function($value) {
                return '"' . str_replace('"', '""', $value) . '"';
            }, $row);
            $content .= implode(',', $row) . "\n";
        }
        return $content;
    }

}