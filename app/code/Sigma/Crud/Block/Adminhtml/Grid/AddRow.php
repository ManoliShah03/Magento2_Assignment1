<?php

namespace Sigma\Crud\Block\Adminhtml\Grid;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Registry;
use Magento\Framework\View\Helper\SecureHtmlRenderer;

class AddRow extends Container
{
    public function __construct(
        Context $context,
        private Registry $registry,
        array $data = [],
        ?SecureHtmlRenderer $secureRenderer = null
    )
    {
        parent::__construct($context, $data, $secureRenderer);
    }

    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Sigma_Crud';
        $this->_controller = 'adminhtml_grid';
        parent::_construct();
        if ($this->_isAllowedAction('Sigma_Crud::add_row')) {
            $this->buttonList->update('save', 'label', __('Save'));
        } else {
            $this->buttonList->remove('save');
        }
        $this->buttonList->remove('reset');
    }

    public function getHeaderText()
    {
        return __('Add Row Data');
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
        return $this->getUrl('*/*/save');
    }
}
