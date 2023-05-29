<?php
class Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt_Csv_ShowOption extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract		
{
	public function render($row)
	{
		if ($row->frontend_input == 'select' || $row->frontend_input == 'multiselect') {
			$href = "<a href='".$this->getUrl('*/*/optionGrid',['attribute_id'=>$row->getId()])."'>Show Option</a>";
		}

		return $href;
	}
}