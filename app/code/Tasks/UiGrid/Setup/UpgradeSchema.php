<?php

namespace Tasks\UiGrid\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;

        $installer->startSetup();
        if(version_compare($context->getVersion(), '1.0.1', '<')) {
            $installer->getConnection()->addColumn(
                'items_five',
                'status',
                [
                    'type'=>\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    'nullable'=>false,
                    'comment'=> 'Statuses 0 - disable, 1 - enable, 2 - archive',
                    'default'=>0
                ]
            );
        }

        $installer->endSetup();
    }
}