<?php 

class Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct()
	{
        parent::__construct();
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('eavmgmt')->__('Eavmgmt Information'));
	}

	public function getEavmgmt()
    {
        return Mage::registry('current_eavmgmt');
    }

    protected function _beforeToHtml()
    {
        $eavmgmt = Mage::registry('current_eavmgmt');
        $setModel = Mage::getModel('eav/entity_attribute_set');

        if (!($setId = $eavmgmt->getAttributeSetId())) {
            $setId = $this->getRequest()->getParam('set', null);
        }

        if ($setModel->load($setId)->getAttributeSetId()) {
            
            $eavmgmtAttributes = Mage::getResourceModel('eavmgmt/eavmgmt_attribute_collection');

            if (!$eavmgmt->getId()) {
                foreach ($eavmgmtAttributes as $attribute) {
                    $default = $attribute->getDefaultValue();
                    if ($default != '') {
                        $eavmgmt->setData($attribute->getAttributeCode(), $default);
                    }
                }
            }

            $groupCollection = Mage::getResourceModel('eav/entity_attribute_group_collection')
                ->setAttributeSetFilter($setId)
                ->setSortOrder()
                ->load();

            $defaultGroupId = 0;
            foreach ($groupCollection as $group) {
                if ($defaultGroupId == 0 or $group->getIsDefault()) {
                    $defaultGroupId = $group->getId();
                }

            }	

            foreach ($groupCollection as $group) {
                $attributes = array();
                foreach ($eavmgmtAttributes as $attribute) {
                    if ($eavmgmt->checkInGroup($attribute->getId(),$setId, $group->getId())) {
                        $attributes[] = $attribute;
                    }
                }

                if (!$attributes) {
                    continue;
                }

                $active = $defaultGroupId == $group->getId();
                $block = $this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_edit_tab_attributes')
                    ->setGroup($group)
                    ->setAttributes($attributes)
                    ->setAddHiddenFields($active)
                    ->toHtml();

                $this->addTab('group_' . $group->getId(), array(
                    'label'     => Mage::helper('eavmgmt')->__($group->getAttributeGroupName()),
                    'content'   => $block,
                    'active'    => $active
                ));
            }
        } else {
            $this->addTab('set', array(
                'label'     => Mage::helper('eavmgmt')->__('Settings'),
                'content'   => $this->_translateHtml($this->getLayout()
                    ->createBlock('eavmgmt/adminhtml_eavmgmt_edit_tab_setting')->toHtml()),
                'active'    => true
            ));
        }
      return parent::_beforeToHtml();
    }

    protected function _translateHtml($html)
    {
        Mage::getSingleton('core/translate_inline')->processResponseBody($html);
        return $html;
    }
}