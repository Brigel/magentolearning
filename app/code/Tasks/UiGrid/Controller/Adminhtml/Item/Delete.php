<?php
namespace Tasks\UiGrid\Controller\Adminhtml\Item;

class Delete extends \Tasks\UiGrid\Controller\Adminhtml\Item
{
    /**
     * execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->_resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('item_id');
        if ($id) {
            $name = "";
            try {
                /** @var \Tasks\UiGrid\Model\Item $item */
                $item = $this->_itemFactory->create();
                $item->load($id);
                $name = $item->getName();
                $item->delete();
                $this->messageManager->addSuccess(__('The Item has been deleted.'));
                $this->_eventManager->dispatch(
                    'adminhtml_tasks_uigrid_item_on_delete',
                    ['name' => $name, 'status' => 'success']
                );
                $resultRedirect->setPath('uigrid/*/');
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_tasks_uigrid_item_on_delete',
                    ['name' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('uigrid/*/edit', ['item_id' => $id]);
                return $resultRedirect;
            }
        }
        // display error message
        $this->messageManager->addError(__('Item to delete was not found.'));
        // go to grid
        $resultRedirect->setPath('uigrid/*/');
        return $resultRedirect;
    }
}
