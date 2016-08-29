<?php

namespace CzoneTech\Slider\Api\Data;

interface SliderItemInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const SLIDER_ITEM_ID       = 'slider_item_id';
    const TITLE         = 'title';
    const CONTENT       = 'content';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
    const IS_ACTIVE     = 'is_active';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();


    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * Set ID
     *
     * @param int $id
     * @return \CzoneTech\Slider\Api\Data\PostInterface
     */
    public function setId($id);


    /**
     * Set title
     *
     * @param string $title
     * @return \CzoneTech\Slider\Api\Data\PostInterface
     */
    public function setTitle($title);

    /**
     * Set content
     *
     * @param string $content
     * @return \CzoneTech\Slider\Api\Data\PostInterface
     */
    public function setContent($content);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return \CzoneTech\Slider\Api\Data\PostInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return \CzoneTech\Slider\Api\Data\PostInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set is active
     *
     * @param int|bool $isActive
     * @return \CzoneTech\Slider\Api\Data\PostInterface
     */
    public function setIsActive($isActive);
}