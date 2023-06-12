<?php
class Saksham_Banner_Adminhtml_BannerController extends Mage_Adminhtml_Controller_Action
{
    public function uploadImageAction()
    {
        try {
            $images = $_FILES['images'];
            if($images['error'][0]!=0){
                throw new Exception("Please select the banner image.", 1);
            }

            foreach ($images['name'] as $key => $type) {
                $extension = pathinfo($type, PATHINFO_EXTENSION);
            }

            foreach ($images['tmp_name'] as $index => $tmpName) {
                $model = Mage::getModel('banner/banner');
                $groupId = $this->getRequest()->getParam('group_id');
                $model->addData(['group_id'=>$groupId, 'created_at'=>date('y:m:d H:i:s')])->save();
                
                $uploader = new Mage_Core_Model_File_Uploader('images[' . $index . ']');
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);

                $uploadDir = Mage::getBaseDir('media') . DS . 'Banner' . DS . 'original';

                $uploadedFilePath = $uploadDir . DS . $uploader->getUploadedFileName();
                if ($uploader->save($uploadDir, $model->getId().".".$extension)) {
                    $model->image = $model->getId().".".$extension;
                    $model->save();
                }
            }

            Mage::getModel('banner/banner')->resize();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('brand')->__('Image was successfully uploaded'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }

        $this->_redirect('*/adminhtml_group/edit',array('group_id'=>$this->getRequest()->getParam('group_id')));
    }

    public function saveAction()
    {
        try {
            $groupId = $this->getRequest()->getParam('group_id');
            $data = $this->getRequest()->getPost();
            foreach ($data['status'] as $id => $value) {
                $model = Mage::getModel('banner/banner');
                $model->setId($id);
                $model->status = $value;
                $model->save();
            }

            foreach ($data['position'] as $id => $value) {
                $model = Mage::getModel('banner/banner');
                $model->setId($id);
                $model->position = $value;
                $model->save();
            }

        $this->_redirect('*/adminhtml_group/edit',array('group_id'=>$this->getRequest()->getParam('group_id')));

        } catch (Exception $e) {
            
        }
    }
}