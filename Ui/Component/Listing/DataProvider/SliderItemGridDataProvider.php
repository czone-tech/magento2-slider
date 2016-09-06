<?php

namespace CzoneTech\Slider\Ui\Component\Listing\DataProvider;

use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class SliderItemGridDataProvider extends AbstractDataProvider
{

    const SESSION_KEY_SLIDER_ID = 'slider_item_grid.slider_id';
    /**
     * @var RequestInterface
     */
    protected  $_request;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        RequestInterface $request,
        \CzoneTech\Slider\Model\ResourceModel\SliderItem\CollectionFactory $collectionFactory,
        \Magento\Framework\Session\SessionManagerInterface $sessionManager,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->_request = $request;
        $this->collection = $collectionFactory->create();
        $sliderId = $this->_request->getParam('slider_id') ? $this->_request->getParam('slider_id'):
            $sessionManager->getData(self::SESSION_KEY_SLIDER_ID);
        if($sliderId){
            $sessionManager->setData(self::SESSION_KEY_SLIDER_ID, $sliderId);
            $this->getCollection()->addFieldToFilter('slider_id', $sliderId);
        }


    }

}