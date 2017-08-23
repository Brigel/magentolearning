<?php
namespace Tasks\UiGrid\Controller\Adminhtml\Item;

class Index extends \Magento\Backend\App\Action
{
    /**
     * Page result factory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Page factory
     *
     * @var \Magento\Backend\Model\View\Result\Page
     */
    protected $_resultPage;

    /**
     * constructor
     *
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * execute the action
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $this->_setPageData();
        return $this->getResultPage();
    }
    /**
     * instantiate result page object
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
     */
    public function getResultPage()
    {
        if (is_null($this->_resultPage)) {
            $this->_resultPage = $this->_resultPageFactory->create();
        }
        return $this->_resultPage;
    }
    /**
     * set page data
     *
     * @return $this
     */
    protected function _setPageData()
    {
        \Magento\Framework\Profiler::start('pageLoad');
        $resultPage = $this->getResultPage();
        $resultPage->setActiveMenu('Tasks_UiGrid::item');
        $resultPage->getConfig()->getTitle()->prepend((__('Items')));
        \Magento\Framework\Profiler::stop('pageLoad');
        return $this;
    }
}
