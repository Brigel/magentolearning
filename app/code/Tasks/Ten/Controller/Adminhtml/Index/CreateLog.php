<?php
namespace Tasks\Ten\Controller\Adminhtml\Index;

use Braintree\Exception;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;

class CreateLog extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    protected $logger;
    public function __construct(Context $context, PageFactory $pageFactory, LoggerInterface $logger)
    {
        $this->pageFactory = $pageFactory;
        $this->logger = $logger;
        return parent::__construct($context);
    }
    public function execute()
    {
        $moduleName = $this->getRequest()->getModuleName();
        $controller = $this->getRequest()->getControllerName();
        $action     = $this->getRequest()->getActionName();
        $message = $moduleName.' '.$controller.' '.$action.' ';
        $this->logger->addDebug("LOG DEBUG: $message"); // log location: var/log/system.log
        $this->logger->addInfo("LOG INFO: $message"); // log location: var/log/exception.log
        $this->logger->addNotice("LOG NOTICE: $message"); // log location: var/log/exception.log
        $this->logger->addError("LOG ERROR: $message"); // log location: var/log/exception.log
        $this->logger->critical(new Exception("LOG EXCEPTION CRITICAL: $message")); // log location: var/log/exception.log

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}