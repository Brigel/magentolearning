<?php
namespace Tasks\UiGrid\Block\Adminhtml;

class Item extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_item';
        $this->_blockGroup = 'Tasks_UiGrid';
        $this->_headerText = __('Items');
        $this->_addButtonLabel = __('Create New Item');
        parent::_construct();
    }
}
