<?php
/**
 * Created by PhpStorm.
 * User: ashish
 * Date: 2/9/16
 * Time: 6:25 PM
 */

namespace CzoneTech\Slider\Block\Widget\Slider;

use CzoneTech\Slider\Model\Slider;
use CzoneTech\Slider\Model\SliderFactory;
use Magento\Framework\View\Element\Template;

class Block extends Template implements \Magento\Widget\Block\BlockInterface
{

    protected $sliderFactory;

    /**
     * Constructor
     *
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(Template\Context $context,
                                SliderFactory $sliderFactory,
                                array $data = [])
    {
        $this->sliderFactory = $sliderFactory;
        parent::__construct($context, $data);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        $sliderId = $this->getData('slider_id');
        $slider = $this->sliderFactory->create()->load($sliderId);
        if($slider->getContentType() == Slider::CONTENT_TYPE_PRODUCTS){
            $blockName = \CzoneTech\Slider\Block\Widget\Slider\Product::class;
        }else{
            $blockName = \CzoneTech\Slider\Block\Widget\Slider\Image::class;
        }
        return $this->_layout->createBlock($blockName)->toHtml();
    }

}