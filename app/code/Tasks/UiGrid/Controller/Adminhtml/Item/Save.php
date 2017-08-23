<?php
namespace Tasks\UiGrid\Controller\Adminhtml\Item;

class Save extends \Tasks\UiGrid\Controller\Adminhtml\Item
{
    /**
     * Backend session
     * 
     * @var \Magento\Backend\Model\Session
     */
    protected $_backendSession;

    /**
     * constructor
     * 
     * @param \Magento\Backend\Model\Session $backendSession
     * @param \Tasks\UiGrid\Model\ItemFactory $itemFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\Model\Session $backendSession,
        \Tasks\UiGrid\Model\ItemFactory $itemFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_backendSession = $backendSession;
        parent::__construct($itemFactory, $registry, $resultRedirectFactory, $context);
    }

    /**
     * run the action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPost('item');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data = $this->_filterData($data);
            $item = $this->_initItem();
            $item->setData($data);
            $this->_eventManager->dispatch(
                'tasks_uigrid_item_prepare_save',
                [
                    'item' => $item,
                    'request' => $this->getRequest()
                ]
            );
            try {
                $item->save();
                $this->messageManager->addSuccess(__('The Item has been saved.'));
                $this->_backendSession->setTasksUiGridItemData(false);
                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath(
                        'uigrid/*/edit',
                        [
                            'item_id' => $item->getId(),
                            '_current' => true
                        ]
                    );
                    return $resultRedirect;
                }
                $resultRedirect->setPath('uigrid/*/');
                return $resultRedirect;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Item.'));
            }
            $this->_getSession()->setTasksUiGridItemData($data);
            $resultRedirect->setPath(
                'uigrid/*/edit',
                [
                    'item_id' => $item->getId(),
                    '_current' => true
                ]
            );
            return $resultRedirect;
        }
        $resultRedirect->setPath('uigrid/*/');
        return $resultRedirect;
    }

    /**
     * filter values
     *
     * @param array $data
     * @return array
     */
    protected function _filterData($data)
    {
        if (isset($data['sample_multiselect'])) {
            if (is_array($data['sample_multiselect'])) {
                $data['sample_multiselect'] = implode(',', $data['sample_multiselect']);
            }
        }
        return $data;
    }
}
