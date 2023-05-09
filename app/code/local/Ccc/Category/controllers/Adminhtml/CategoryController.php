<?php
class Ccc_Category_Adminhtml_CategoryController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Category'))
             ->_title($this->__('Manage Categorys'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('category/adminhtml_category'));
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('category_id');
        $model = Mage::getModel('category/category')->load($id);
        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('category_data', $model);
            $this->loadLayout();
            $this->_setActiveMenu('category/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            $this->_addContent($this->getLayout()->createBlock(' category/adminhtml_category_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('category/adminhtml_category_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('category')->__('Category does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try {
            $categoryModel = Mage::getModel('category/category');
            $categoryData = $this->getRequest()->getPost('category');
            $categoryModel->setData($categoryData)
                ->setId($this->getRequest()->getParam('id'));

            if ($categoryModel->category_id == NULL) {
                $categoryModel->created_at = date("y-m-d H:i:s");
            } else {
                $categoryModel->updated_at = date("y-m-d H:i:s");
            }

            $categoryModel->save();

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('category')->__('Category was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(true);

            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $categoryModel->getId()));
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
        $categoryIds = $this->getRequest()->getParam('category_id');
        if(!is_array($categoryIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('category/category')->__('Please select category(s).'));
        } else {
            try {
                $model = Mage::getModel('category/category');
                foreach ($categoryIds as $categoryId) {
                    $model->load($categoryId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('category')->__(
                    'Total of %d record(s) were deleted.', count($categoryIds)
                )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
}