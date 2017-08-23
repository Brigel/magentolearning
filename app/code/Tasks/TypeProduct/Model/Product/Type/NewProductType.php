<?php

namespace Tasks\TypeProduct\Model\Product\Type;

class NewProductType extends \Magento\Catalog\Model\Product\Type\AbstractType {

    const TYPE_ID = 'new_product_type';

    /**
     * Delete data specific for this product type
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    public function deleteTypeSpecificData(\Magento\Catalog\Model\Product $product)
    {
        // TODO: Implement deleteTypeSpecificData() method.
    }
}