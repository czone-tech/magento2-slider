<?php
/**
 * Created by PhpStorm.
 * User: ashish
 * Date: 25/8/16
 * Time: 5:32 PM
 */

namespace CzoneTech\Slider\Controller\Adminhtml\Slider;


use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;

class Delete extends \Magento\Backend\App\Action
{

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Czonetech_Slider::delete_slider');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('slider_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('CzoneTech\Slider\Model\Slider');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The record has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['slider_id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a record to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}