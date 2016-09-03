<?php

namespace CzoneTech\Slider\Model;

use CzoneTech\Slider\Api\Data\SliderInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Slider extends AbstractModel implements SliderInterface, IdentityInterface
{

    /**#@+
     * Slider's Statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**#@+
     * Slider's Statuses
     */

    const CONTENT_TYPE_CUSTOM = 1;
    const CONTENT_TYPE_IMAGE = 2;
    const CONTENT_TYPE_VIDEO = 3;

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'ctslider_slider';

    /**
     * @var string
     */
    protected $_cacheTag = 'ctslider_slider';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'ctslider_slider';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('CzoneTech\Slider\Model\ResourceModel\Slider');
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
    public function getContentType()
    {
        return $this->getData(self::CONTENT_TYPE);
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
     * @param string $contentType
     * @return \CzoneTech\Slider\Api\Data\SliderInterface
     */
    public function setContentType($contentType)
    {
        return $this->setData(self::CONTENT_TYPE, $contentType);
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
     * Prepare post's statuses.
     * Available event ctslider_slider_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableContentTypes()
    {
        return [self::CONTENT_TYPE_CUSTOM => __('Custom'), self::CONTENT_TYPE_IMAGE => __('Image'),
            self::CONTENT_TYPE_VIDEO => __('Video')];
    }

}