<?php

namespace CzoneTech\Slider\Ui\Component\Listing\DataProvider;

use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class SliderGridDataProvider extends AbstractDataProvider
{
    /**
     * @var RequestInterface
     */
    protected  $_request;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        RequestInterface $request,
        \CzoneTech\Slider\Model\ResourceModel\Slider\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->_request = $request;
        $this->collection = $collectionFactory->create();

    }

}