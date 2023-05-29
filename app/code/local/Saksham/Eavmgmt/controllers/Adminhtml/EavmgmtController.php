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

    public function newAction()
    {
        $this->_title($this->__('Attributes'))
             ->_title($this->__('Import Options'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('eavmgmt/adminhtml_eavmgmt_edit_tabs'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        echo "string";
    }

    public function massExportCsvAttributeAction()
    {
        $fileName = 'attribute_'.date('ymd_His').'.csv';
        $content = $this->_getCsvContent();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    protected function _getCsvContent()
    {
        $attributeIds = $this->getRequest()->getPost('attribute_id');
        $collection = Mage::getResourceModel('eavmgmt/eavmgmt_collection');
        $collection->addFieldToFilter('attribute_id', array('in' => $attributeIds));
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

    public function massExportCsvAttributeOptionAction()
    {
        $fileName = 'attributeoptions_'.date('ymd_His').'.csv';
        $content = $this->_getCsvContentOption();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    protected function _getCsvContentOption()
    {
        $attributeIds = $this->getRequest()->getPost('attribute_id');
        $collection = Mage::getResourceModel('eav/entity_attribute_option_collection');
        $collection->getSelect()
            ->join(
                array('ea' => 'eav_attribute'),
                'main_table.attribute_id = ea.attribute_id',
                array('entity_type_id','frontend_label','attribute_code')
            );
        $collection->addFieldToFilter('main_table.attribute_id', array('in' => $attributeIds));
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