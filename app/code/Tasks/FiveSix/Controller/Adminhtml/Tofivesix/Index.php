<?php
namespace Tasks\FiveSix\Controller\Adminhtml\Tofivesix;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    protected $forLink;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $this->_redirect('http://'.$this->getRequest()->getUri()->getHost()."/fivesix/Items/printitems");
    }
}