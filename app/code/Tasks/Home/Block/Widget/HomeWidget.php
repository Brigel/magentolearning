<?php
namespace Tasks\Home\Block\Widget;

class HomeWidget extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('widget/home_widget.phtml');
    }

}