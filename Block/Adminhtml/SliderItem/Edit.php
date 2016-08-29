<?php

namespace CzoneTech\Slider\Block\Adminhtml\SliderItem;

use Magento\Framework\View\Element\Template;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize blog post edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'slider_item_id';
        $this->_blockGroup = 'CzoneTech_Slider';
        $this->_controller = 'adminhtml_sliderItem';

        parent::_construct();

        if ($this->_isAllowedAction('CzoneTech_Slider::save_slideritem')) {
            $this->buttonList->update('save', 'label', __('Save Slider Item'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

        if ($this->_isAllowedAction('CzoneTech_Slider::delete_slideritem')) {
            $this->buttonList->update('delete', 'label', __('Delete Slider Item'));
        } else {
            $this->buttonList->remove('delete');
        }
    }

    /**
     * Retrieve text for header element depending on loaded post
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('ctslider_slideritem')->getId()) {
            return __("Edit Slider Item '%1'", $this->escapeHtml($this->_coreRegistry->registry('ctslider_slideritem')
                ->getTitle()));
        } else {
            return __('New Slider Item');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('ctslider/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}