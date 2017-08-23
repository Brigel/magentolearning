<?php
namespace Tasks\UiGrid\Model;

/**
 * @method Item setName($name)
 * @method Item setUrlKey($urlKey)
 * @method Item setItemContent($itemContent)
 * @method Item setTags($tags)
 * @method Item setStatus($status)
 * @method Item setFeaturedImage($featuredImage)
 * @method Item setSampleCountrySelection($sampleCountrySelection)
 * @method Item setSampleUploadFile($sampleUploadFile)
 * @method Item setSampleMultiselect($sampleMultiselect)
 * @method mixed getName()
 * @method mixed getUrlKey()
 * @method mixed getItemContent()
 * @method mixed getTags()
 * @method mixed getStatus()
 * @method mixed getFeaturedImage()
 * @method mixed getSampleCountrySelection()
 * @method mixed getSampleUploadFile()
 * @method mixed getSampleMultiselect()
 * @method Item setCreatedAt(\string $createdAt)
 * @method string getCreatedAt()
 * @method Item setUpdatedAt(\string $updatedAt)
 * @method string getUpdatedAt()
 */
class Item extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Cache tag
     * 
     * @var string
     */
    const CACHE_TAG = 'itemtasks_uigrid_item';

    /**
     * Cache tag
     * 
     * @var string
     */
    protected $_cacheTag = 'itemtasks_uigrid_item';

    /**
     * Event prefix
     * 
     * @var string
     */
    protected $_eventPrefix = 'itemtasks_uigrid_item';


    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tasks\UiGrid\Model\ResourceModel\Item');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * get entity default values
     *
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
