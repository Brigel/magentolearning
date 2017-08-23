<?php
namespace Tasks\Four\Block;

class Main extends \Magento\Framework\View\Element\Template
{
    public function printOtherLinksToTemplates($dirPath, $currentFile)
    {
        $links = $this->getOtherLinks($dirPath,$currentFile);
        foreach ($links as $link) {
            $name = $link["name"];
            $url = $link["url"];
            echo "<a href='$url'>Go to: $name</a><br>";
        }
    }

    public function getOtherLinks($dirPath, $currentFile)
    {
        $notNeededFiles = ['.', '..', $currentFile];
        $urls = [];
        foreach (scandir($dirPath) as $file) {
            if(!in_array($file,$notNeededFiles)){
                $fileName = pathinfo($file, PATHINFO_FILENAME);

                $urlControllerAction = str_replace ( '_', '/' , $fileName);

                $route = $this->getRequest()->getRouteName();
                $url = $route.'/'.$urlControllerAction;

                $nameLink = str_replace ( '_', ' ' , $fileName);

                array_push($urls, ["name"=>$nameLink,"url"=>$this->getUrl($url)]);
            }
        }

        return $urls;
    }
}