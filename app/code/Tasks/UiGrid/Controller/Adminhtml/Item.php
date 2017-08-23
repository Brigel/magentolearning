<?php
namespace Tasks\UiGrid\Controller\Adminhtml;

abstract class Item extends \Magento\Backend\App\Action
{
    /**
     * Item Factory
     * 
     * @var \Tasks\UiGrid\Model\ItemFactory
     */
    protected $_itemFactory;

    /**
     * Core registry
     * 
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Result redirect factory
     * 
     * @var \Magento\Backend\Model\View\Result\RedirectFactory
     */
    protected $_resultRedirectFactory;

    /**
     * constructor
     * 
     * @param \Tasks\UiGrid\Model\ItemFactory $itemFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Tasks\UiGrid\Model\ItemFactory $itemFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_itemFactory           = $itemFactory;
        $this->_coreRegistry          = $coreRegistry;
        $this->_resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    /**
     * Init Item
     *
     * @return \Tasks\UiGrid\Model\Item
     */
    protected function _initItem()
    {
        $itemId  = (int) $this->getRequest()->getParam('item_id');
        /** @var \Tasks\UiGrid\Model\Item $item */
        $item    = $this->_itemFactory->create();
        if ($itemId) {
            $item->load($itemId);
        }
        $this->_coreRegistry->register('tasks_uigrid_item', $item);
        return $item;
    }
}
