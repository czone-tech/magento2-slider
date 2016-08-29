<?php
/**
 * Created by PhpStorm.
 * User: ashish
 * Date: 25/8/16
 * Time: 5:57 PM
 */

namespace CzoneTech\Slider\Controller\Adminhtml\SliderItem;


use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action
{

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Framework\Image\Factory
     */
    protected $imageFactory;

    /**
     * @var \Magento\Framework\Image\Factory
     */
    protected $mediaDirectory;

    /**
     * @var \Magento\Framework\View\Asset\Repository
     */
    protected $assetRepo;

    /**
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Image\Factory $imageFactory
     * @param \Magento\Framework\Filesystem $fileSystem
     * @param \Magento\Framework\View\Asset\Repository $assetRepo
     * @param Action\Context $context
     */
    public function __construct(\Magento\Store\Model\StoreManagerInterface $storeManager,
                                \Magento\Framework\Image\Factory $imageFactory,
                                \Magento\Framework\Filesystem $fileSystem,
                                \Magento\Framework\View\Asset\Repository $assetRepo,
                                Action\Context $context)
    {
        $this->storeManager = $storeManager;
        $this->imageFactory = $imageFactory;
        /** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
        $this->mediaDirectory = $fileSystem->getDirectoryRead(DirectoryList::MEDIA);
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('CzoneTech_Slider::save_slideritem');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \CzoneTech\Slider\Model\Slider $model */
            $model = $this->_objectManager->create('\CzoneTech\Slider\Model\SliderItem');

            $id = $this->getRequest()->getParam('slider_item_id');
            if ($id) {
                $model->load($id);
            }
            try{
                $data['image_url'] = $this->saveImage();
            } catch (\Exception $e) {
                $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
                $this->messageManager->addException($e, __('Something went wrong while uploading the file.'));
                $this->_getSession()->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', ['slider_item_id' => $this->getRequest()->getParam
                ('slider_item_id')]);
            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                'ctslider_slideritem_prepare_save',
                ['slideritem' => $model, 'request' => $this->getRequest()]
            );

            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved this item.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['slider_item_id' => $model->getId(), '_current' =>
                        true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the record.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['slider_item_id' => $this->getRequest()->getParam
            ('slider_item_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    protected function saveImage(){
        $uploader = $this->_objectManager->create(
            'Magento\MediaStorage\Model\File\Uploader',
            ['fileId' => 'image_url']
        );
        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
        /** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
        $imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
        $uploader->addValidateCallback('ctslider_slideritem_image', $imageAdapter, 'validateUploadFile');
        $uploader->setAllowRenameFiles(true);
        $uploader->setFilesDispersion(true);


        $result = $uploader->save($this->getBaseMediaPath());
        $this->generateThumbnails($result['file'], $this->getBaseMediaPath());
        $this->_eventManager->dispatch(
            'ctslider_slideritem_gallery_upload_image_after',
            ['result' => $result, 'action' => $this]
        );

        unset($result['tmp_name']);
        unset($result['path']);

        $result['url'] = $this->getBaseMediaUrl(). $result['file'];
        return $result['url'];

    }

    protected function getBaseMediaPath(){
        return $this->mediaDirectory->getAbsolutePath('slider/slideritem');
    }

    protected function getBaseMediaUrl(){
        return $this->storeManager->getStore()->getBaseUrl(
            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
        ).'slider/slideritem';
    }

    /**
     * @return string
     */
    public function getImageUrl($filePath)
    {
        if (!$this->mediaDirectory->isFile($filePath)) {
            $url = $this->assetRepo->getUrl(
                "CzoneTech_Slider::images/slideritem/placeholder/thumbnail.jpg"
            );
        } else {
            $url = $this->storeManager->getStore()->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                ) . $filePath;
        }

        return $url;
    }

    public function generateThumbnails($fileName, $destinationBaseDir){

        $configs = [
            [
                'width' => 100,
                'height' => 100
            ],
            [
                'width' => 200,
                'height' => 200
            ],
        ];
        // build new filename (most important params)


        foreach($configs as $config){
            $processor = $this->imageFactory->create($destinationBaseDir.$fileName);
            $processor->keepTransparency(true);
            $processor->keepAspectRatio(true);
            $processor->resize($config['width'], $config['height']);
            $path = [
                $destinationBaseDir,
                'cache',
                $this->storeManager->getStore()->getId(),
                'thumbnail'
            ];
            $path[] = "{$config['width']}x{$config['height']}";
            $newFile = implode('/', $path) . $fileName;
            $processor->save($newFile);
        }
    }

}