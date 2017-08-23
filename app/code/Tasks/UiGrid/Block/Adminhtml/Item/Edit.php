<?php
namespace Tasks\UiGrid\Block\Adminhtml\Item;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     * 
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * constructor
     * 
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    )
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize Item edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'item_id';
        $this->_blockGroup = 'Tasks_UiGrid';
        $this->_controller = 'adminhtml_item';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Item'));
        $this->buttonList->add(
            'save-and-continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('delete', 'label', __('Delete Item'));
    }
    /**
     * Retrieve text for header element depending on loaded Item
     *
     * @return string
     */
    public function getHeaderText()
    {
        /** @var \Tasks\UiGrid\Model\Item $item */
        $item = $this->_coreRegistry->registry('tasks_uigrid_item');
        if ($item->getId()) {
            return __("Edit Item '%1'", $this->escapeHtml($item->getName()));
        }
        return __('New Item');
    }
}
