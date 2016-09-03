<?php

namespace CzoneTech\Slider\Block\Widget\Slider;

use Magento\Framework\View\Element\Template;

class Image extends Template
{

    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template = 'CzoneTech_Slider::slider/image.phtml';

    /**
     * @var \CzoneTech\Slider\Model\ResourceModel\SliderItem\Collection
     */
    protected $_sliderItemCollection;

    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $_filterProvider;

    /**
     * Constructor
     *
     * @param Template\Context $context
     * @param \CzoneTech\Slider\Model\ResourceModel\SliderItem\Collection $sliderItemCollection
     * @param \Magento\Cms\Model\Template\FilterProvider $filterProvider
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \CzoneTech\Slider\Model\ResourceModel\SliderItem\Collection $sliderItemCollection,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        array $data = [])
    {
        $this->_filterProvider = $filterProvider;
        $this->_sliderItemCollection = $sliderItemCollection;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Cms\Model\Template\FilterProvider
     */
    public function getFilterProvider(){
        return $this->_filterProvider;
    }

    /**
     * @return \CzoneTech\Slider\Model\SliderItem[]
     */
    public function getSliderItems(){
        $sliderId = $this->getData('slider_id');
        $collection = $this->_sliderItemCollection
            ->addFieldToFilter('slider_id', $sliderId)
            ;
        return $collection->load();
    }
}