<?php
class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Price_Renderer_Price extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $inputId = 'salesman_price' . $row->product_id;
        $inputValue = $row->getData('salesman_price');

        $html = '<input type="text" id="' . $inputId . '" name="salesman_price[' . $row->product_id . ']" value="' . $inputValue . '" class="input-text">';
        return $html;
    }
}