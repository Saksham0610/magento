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
        if ($_FILES['import_options']['error'] == UPLOAD_ERR_OK) {
            $csvFile = $_FILES['import_options']['tmp_name'];
            $csvData = file_get_contents($csvFile);
            $csvData = array();

            if (($handle = fopen($csvFile, 'r')) !== false) {
                while (($data = fgetcsv($handle)) !== false) {
                    $row = array();
                    foreach ($data as $value) {
                        $row[] = $value;
                    }
                    $csvData[] = $row;
                }
                  fclose($handle);
            }

            $header = [];
            foreach ($csvData as $value)
            {
                if(!$header)
                {
                    $header = $value;
                }
                else
                {
                    $data = array_combine($header,$value);

                    $collection = Mage::getResourceModel('eav/entity_attribute_collection');
                    $collection->setCodeFilter($data['Attribute Code']);
                    $attribute = $collection->getData();

                    $collection = Mage::getModel('eav/entity_attribute_option')->getCollection();
                    $collection->getSelect()
                    ->join(
                        array('eav_attribute_option_value' => Mage::getSingleton('core/resource')->getTableName('eav_attribute_option_value')),
                        'main_table.option_id = eav_attribute_option_value.option_id',
                        array('value')
                    )
                    ->where('eav_attribute_option_value.value = ?', $data['Option Name']);
                    $existingOption = $collection->getData();

                    $optionModel = Mage::getModel('eav/entity_attribute_option');
                    if (!$existingOption) {
                        $setData = ['attribute_id' => $attribute[0]['attribute_id'],'sort_order'=>$data['Option Order']];                            
                        $optionModel->setData($setData);
                        $optionModel->save();

                        $resource = Mage::getSingleton('core/resource');
                        $connection = $resource->getConnection('core_write');
                        $tableName = $resource->getTableName('eav_attribute_option_value');

                        $data = array(
                            'option_id' => $optionModel->option_id,
                            'store_id' => 0,
                            'value' => $data['Option Name']
                        );

                        try {
                            $connection->insert($tableName, $data);
                            echo "Value inserted successfully.";
                        } catch (Exception $e) {
                            echo "Error: " . $e->getMessage();
                        }


                        echo $optionValueModel->value_id;
                    }
                }
            }
        }

        $this->_redirect('*/adminhtml_eavmgmt/index');
    }

    public function massExportCsvAttributeAction()
    {
        $fileName = 'attribute_'.date('ymd_His').'.csv';
        $content = $this->_getCsvContent();
        $this->_prepareDownloadResponse($fileName, $content);
        $attributes = $this->getRequest()->getPost('attribute_id');
            $fileName   ='attributeoptions_'.date('Ymd_His').'.csv';
             $collection = Mage::getResourceModel('eav/entity_attribute_option_collection');
             $collection->getSelect()
            ->join(
                array('second_table' => 'eav_attribute'),
                'main_table.attribute_id = second_table.attribute_id',
                array('entity_type_id','frontend_label','attribute_code')
            );
            $collection->addFieldToFilter('main_table.attribute_id', array('in' => $attributes));
            $this->_prepareDownloadResponse($fileName, $content);
            $grid= $this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_exportoption');
            $grid->setCollection($collection);
            $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
             $this->_redirect('*/*/index');
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
        $attributes = $this->getRequest()->getPost('attribute_id');
        $collection = Mage::getResourceModel('eav/entity_attribute_option_collection');
        $collection->getSelect()
            ->join(
                array('ea' => 'eav_attribute'),
                'main_table.attribute_id = ea.attribute_id',
                array('entity_type_id','frontend_label','attribute_code')
            );
        $collection->addFieldToFilter('main_table.attribute_id', array('in' => $attributes));
        $this->_prepareDownloadResponse($fileName, $content);
        $grid= $this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_exportoption');
        $grid->setCollection($collection);
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
        $this->_redirect('*/*/index');
    }
}