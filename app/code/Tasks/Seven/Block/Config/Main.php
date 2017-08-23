<?php
namespace Tasks\Seven\Block\Config;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\View\Element\Template\Context;

class Main extends \Magento\Framework\View\Element\Template
{
    protected $objectManager;
    public function __construct(ObjectManagerInterface $objectManager, Context $context) {
            $this->objectManager = $objectManager;
            parent::__construct($context);
        }


    public function printConfigs()
    {
        $helper = $this->objectManager->create('Tasks\Seven\Helper\Data');
        echo "<pre>";
        print_r($helper->getGeneralConfig("display_text"));
        echo "</pre>";
    }

}