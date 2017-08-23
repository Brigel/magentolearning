<?php
namespace Tasks\Nine\Model;

class Product extends \Magento\Catalog\Model\Product
{
    public function getStatus()
    {
        return \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED;
    }
}