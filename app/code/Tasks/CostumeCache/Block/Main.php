<?php
namespace Tasks\CostumeCache\Block;

use Magento\Framework\View\Element\Template;

class Main extends \Magento\Framework\View\Element\Template
{
    protected $testCache;

    public function __construct(
        Template\Context $context,
        array $data = [],
        \Tasks\CostumeCache\Model\Cache\TestType $testCache
    )
    {
        $this->testCache = $testCache;
        parent::__construct($context, $data);
    }

    public function getCachedContent()
    {
        $pageContentFromCache = $this->testCache->load('page_content');
        if(!empty($pageContentFromCache)){
            echo $pageContentFromCache;
        }else{
            echo 'SUPER PUPER PAGE ';
            $this->testCache->save('<h2>SUPER PUPER PAGE CONTENT FROM CACHE!!<h2/>','page_content');
        }
    }

}