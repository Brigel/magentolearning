<?php
namespace Tasks\UiGrid\Block\Adminhtml\Item\Edit;

/**
 * @method Tabs setTitle(\string $title)
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('item_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Item Information'));
    }
}
