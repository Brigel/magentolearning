<?php
namespace Tasks\FiveSix\Model\ResourceModel\Item;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Tasks\FiveSix\Model\Item', 'Tasks\FiveSix\Model\ResourceModel\Item');
    }
 
    
}
