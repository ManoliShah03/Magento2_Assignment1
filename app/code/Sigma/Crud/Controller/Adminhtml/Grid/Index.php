<?php

namespace Sigma\Crud\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    public function __construct(
        Context $context,
        private PageFactory $pageFactory
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Form'));

        return $resultPage;
    }
}
