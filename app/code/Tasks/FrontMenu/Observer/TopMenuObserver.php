<?php
namespace Tasks\FrontMenu\Observer;
use Magento\Framework\Event\ObserverInterface;

class TopMenuObserver implements ObserverInterface
{

    protected $urlBuilder;

    /**
     * Catalog category
     *
     * @var \Magento\Catalog\Helper\Category
     */
    protected $catalogCategory;
    /**
     * @var \Magento\Catalog\Model\Indexer\Category\Flat\State
     */
    protected $categoryFlatState;
    /**
     * @var MenuCategoryData
     */
    protected $menuCategoryData;
    /**
     * @param \Magento\Catalog\Helper\Category $catalogCategory
     * @param \Magento\Catalog\Model\Indexer\Category\Flat\State $categoryFlatState
     * @param \Magento\Catalog\Observer\MenuCategoryData $menuCategoryData
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Catalog\Helper\Category $catalogCategory,
        \Magento\Catalog\Model\Indexer\Category\Flat\State $categoryFlatState,
        \Magento\Catalog\Observer\MenuCategoryData $menuCategoryData
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->catalogCategory = $catalogCategory;
        $this->categoryFlatState = $categoryFlatState;
        $this->menuCategoryData = $menuCategoryData;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();
        $block->addIdentity(\Magento\Catalog\Model\Category::CACHE_TAG);
        $categories = $this->catalogCategory->getStoreCategories();

        $this->_clearCategories($categories, $observer->getMenu(), $block);

        $data = [
            'name'=>'About',
            'id'=>'category-node-0',
            'url'=>$this->urlBuilder->getUrl('catalogsearch/advanced/'),
        ];
        $this->_addCategoryToMenu($data, $observer->getMenu(), $block);

        $this->_addCategoriesToMenu($categories, $observer->getMenu(), $block);

        $data = [
            'name'=>'Contact Us',
            'id'=>'category-node-101',
            'url'=>$this->urlBuilder->getUrl('contact'),
        ];
        $this->_addCategoryToMenu($data, $observer->getMenu(), $block);
    }

    protected function _addCategoriesToMenu($categories, $parentCategoryNode, $block)
    {
        foreach ($categories as $category) {
            if (!$category->getIsActive()) {
                continue;
            }
            $block->addIdentity(\Magento\Catalog\Model\Category::CACHE_TAG . '_' . $category->getId());
            $tree = $parentCategoryNode->getTree();

            $categoryData = $this->menuCategoryData->getMenuCategoryData($category);
            $categoryNode = new \Magento\Framework\Data\Tree\Node($categoryData, 'id', $tree, $parentCategoryNode);
            $parentCategoryNode->addChild($categoryNode);

            if ($this->categoryFlatState->isFlatEnabled() && $category->getUseFlatResource()) {
                $subcategories = (array)$category->getChildrenNodes();
            } else {
                $subcategories = $category->getChildren();
            }
            $this->_addCategoriesToMenu($subcategories, $categoryNode, $block);
        }
    }

    protected function _clearCategories($categories, $parentCategoryNode, $block)
    {
        foreach ($categories as $category) {
            $block->addIdentity(\Magento\Catalog\Model\Category::CACHE_TAG . '_' . $category->getId());
            $tree = $parentCategoryNode->getTree();

            $categoryData = $this->menuCategoryData->getMenuCategoryData($category);
            $categoryNode = new \Magento\Framework\Data\Tree\Node($categoryData, 'id', $tree, $parentCategoryNode);
            $parentCategoryNode->removeChild($categoryNode);

        }
    }

    protected function _addCategoryToMenu($data, $parentCategoryNode, $block){
        $block->addIdentity(\Magento\Catalog\Model\Category::CACHE_TAG . '_' . $data['id']);
        $tree = $parentCategoryNode->getTree();
        $categoryNode = new \Magento\Framework\Data\Tree\Node($data, 'id', $tree, $parentCategoryNode);
        $parentCategoryNode->addChild($categoryNode);
    }


}
