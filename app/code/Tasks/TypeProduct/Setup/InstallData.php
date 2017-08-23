<?php

namespace Tasks\TypeProduct\Setup;

use Magento\Catalog\Model\Product;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Tasks\TypeProduct\Model\Product\Type\NewProductType;

class InstallData implements InstallDataInterface
{
    protected $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        // price attributes we want to apply
        // to our product type
        $attributes = [
            'price',
            'special_price',
            'special_from_date',
            'special_to_date',
            'minimal_price',
            'tax_class_id'
        ];

        foreach ($attributes as $attributeCode) {
            $relatedProductTypes = explode(
                ',',
                $eavSetup->getAttribute(Product::ENTITY, $attributeCode, 'apply_to')
            );
            if (!in_array(NewProductType::TYPE_ID, $relatedProductTypes)) {
                $applyTo[] = NewProductType::TYPE_ID;
                $eavSetup->updateAttribute(
                    Product::ENTITY,
                    $attributeCode,
                    'apply_to',
                    join(',', $relatedProductTypes)
                );
            }
        }
    }
}