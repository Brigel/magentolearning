<?php
namespace Tasks\Seven\Controller\Config;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class GetAll extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $this->_view->loadLayout();

        $this->_view->renderLayout();
    }
}