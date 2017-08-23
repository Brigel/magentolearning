<?php
namespace Tasks\FiveSix\Block\Item;

use Tasks\FiveSix\Model\ItemFactory;
use Magento\Framework\View\Element\Template\Context;

class Main extends \Magento\Framework\View\Element\Template
{

    protected $itemsFactory;

    /**
     * @param Context $context
     * @param ItemFactory $itemsFactory
     */
    public function __construct(
        Context $context,
        ItemFactory $itemsFactory
    ) {
        parent::__construct($context);
        $this->itemsFactory = $itemsFactory;
    }

    public function getAllItems()
    {
        $itemsModel = $this->itemsFactory->create();

        $itemsCollection = $itemsModel->getCollection();
        return $itemsCollection->getData();
    }

}