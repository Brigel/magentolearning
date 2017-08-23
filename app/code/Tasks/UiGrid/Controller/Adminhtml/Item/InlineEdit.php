<?php
namespace Tasks\UiGrid\Controller\Adminhtml\Item;

abstract class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * JSON Factory
     * 
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_jsonFactory;

    /**
     * Item Factory
     * 
     * @var \Tasks\UiGrid\Model\ItemFactory
     */
    protected $_itemFactory;

    /**
     * constructor
     * 
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Tasks\UiGrid\Model\ItemFactory $itemFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Tasks\UiGrid\Model\ItemFactory $itemFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_jsonFactory = $jsonFactory;
        $this->_itemFactory = $itemFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->_jsonFactory->create();
        $error = false;
        $messages = [];
        $itemItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($itemItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }
        foreach (array_keys($itemItems) as $itemId) {
            /** @var \Tasks\UiGrid\Model\Item $item */
            $item = $this->_itemFactory->create()->load($itemId);
            try {
                $itemData = $itemItems[$itemId];//todo: handle dates
                $item->addData($itemData);
                $item->save();
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithItemId($item, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithItemId($item, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithItemId(
                    $item,
                    __('Something went wrong while saving the Item.')
                );
                $error = true;
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add Item id to error message
     *
     * @param \Tasks\UiGrid\Model\Item $item
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithItemId(\Tasks\UiGrid\Model\Item $item, $errorText)
    {
        return '[Item ID: ' . $item->getId() . '] ' . $errorText;
    }
}
