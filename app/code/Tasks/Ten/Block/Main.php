<?php
namespace Tasks\Ten\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Filesystem\DirectoryList;

class Main extends \Magento\Framework\View\Element\Template
{
    protected $directoryList;
    public function __construct(Template\Context $context, array $data = [], DirectoryList $directoryList)
    {
        $this->directoryList = $directoryList;
        parent::__construct($context, $data);
    }

    protected $countReadLogRows = 10;

    public function printSystemLogs()
    {
        $logRows=array_reverse (file($this->directoryList->getRoot()."/var/log/system.log"));
        $countRows = count($logRows);
        $stopIndex = $this->countReadLogRows > $countRows?$countRows:$this->countReadLogRows;
        echo "<pre>";
        for ($i=0; $i < $stopIndex; $i++)
        {
            echo $logRows[$i];
        }
        echo "<pre>";
    }

    public function printExceptionsLogs()
    {
        $logRows=array_reverse (file($this->directoryList->getRoot()."/var/log/exception.log"));
        $countRows = count($logRows);
        $stopIndex = $this->countReadLogRows*5 > $countRows?$countRows:$this->countReadLogRows*5;
        $toPrint = [];
        for ($i=0; $i < $stopIndex; $i++)
        {
            array_push($toPrint,$logRows[$i]);
        }
        $toPrint = array_reverse($toPrint);
        echo "<pre>";
        foreach ($toPrint as $item) {
            echo $item;
        }
        echo "</pre>";
    }

    public function getLinkToCreateLogAction()
    {
        return $this->getUrl($this->getRequest()->getRouteName().'/index/createlog');
    }
}