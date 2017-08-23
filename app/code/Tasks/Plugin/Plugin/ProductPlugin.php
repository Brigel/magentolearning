<?php

namespace Tasks\Plugin\Plugin;

class ProductPlugin
{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return  $result . ' low price';
    }
}