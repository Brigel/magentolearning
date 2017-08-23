<?php
namespace Tasks\FiveSix\Model\ResourceModel;
 
class Item extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('items_five', 'id');
    }
}
