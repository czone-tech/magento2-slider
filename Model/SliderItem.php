<?php

namespace CzoneTech\Slider\Model;

use CzoneTech\Slider\Api\Data\SliderItemInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class SliderItem extends AbstractModel implements SliderItemInterface, IdentityInterface
{

    /**#@+
     * Slider's Statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'ctslider_slideritem';

    /**
     * @var string
     */
    protected $_cacheTag = 'ctslider_slideritem';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'ctslider_slideritem';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('CzoneTech\Slider\Model\ResourceModel\SliderItem');
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getSliderId()
    {
        return $this->getData(self::SLIDER_ID);
    }

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive()
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * Prepare post's statuses.
     * Available event ctslider_slider_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * Is active
     *
     * @return bool|null
     */
    public function getImageUrl()
    {
        return $this->getData(self::IMAGE_URL);
    }

    /**
     * Set SliderId
     *
     * @param string $sliderId
     * @return \CzoneTech\Slider\Api\Data\SliderInterface
     */
    public function setSliderId($sliderId)
    {
        return $this->setData(self::SLIDER_ID, $sliderId);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return \CzoneTech\Slider\Api\Data\SliderInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return \CzoneTech\Slider\Api\Data\SliderInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return \CzoneTech\Slider\Api\Data\SliderInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return \CzoneTech\Slider\Api\Data\SliderInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Set is active
     *
     * @param int|bool $isActive
     * @return \CzoneTech\Slider\Api\Data\SliderInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Set is active
     *
     * @param string $url
     * @return \CzoneTech\Slider\Api\Data\SliderInterface
     */
    public function setImageUrl($url)
    {
        return $this->setData(self::IMAGE_URL, $url);
    }




}