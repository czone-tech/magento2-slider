<?php

namespace CzoneTech\Slider\Model\ResourceModel\SliderItem;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'slider_item_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('CzoneTech\Slider\Model\SliderItem', 'CzoneTech\Slider\Model\ResourceModel\SliderItem');
    }

}