<?php
namespace Tasks\FiveSix\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallData implements InstallDataInterface {

    protected $itemFactory;

    public function __construct(
        \Tasks\FiveSix\Model\ItemFactory $itemFactory
    ) {
        $this->itemFactory = $itemFactory;
    }

    public function install( ModuleDataSetupInterface $setup, ModuleContextInterface $context ) {
        $data = [
            [
                'title'=>'qwe',
                'content'=>'asd',
                'url_key'=>'zxczxc',
                'creation_time'=>'2017-08-01 00:00:00'
            ],
            [
                'title'=>'fgj',
                'content'=>'hjl',
                'url_key'=>'123',
                'creation_time'=>'2017-07-01 00:00:00'
            ],
            [
                'title'=>'56hu',
                'content'=>'xcv46',
                'url_key'=>'26235263',
                'creation_time'=>'2017-06-01 00:00:00'
            ]
        ];


        foreach ($data as $item) {
            $setup->getConnection()->insertForce($setup->getTable('items_five'), $item);
        }

    }
}