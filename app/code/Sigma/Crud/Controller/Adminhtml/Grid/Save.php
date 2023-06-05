<?php

namespace Sigma\Crud\Controller\Adminhtml\Grid;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Sigma\Crud\Model\Crud;
use Sigma\Crud\Model\CrudFactory;

class Save extends Action
{

    public function __construct(
        Context $context,
        private CrudFactory $crudFactory
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $data = (array) $this->getRequest()->getPost();

        if(!$data) {
            $this->_redirect('grid/grid/addrow');
            return;
        }

        try {
            $rowData = $this->crudFactory->create();
            $rowData->setData($data)->save();
            if(isset($data['id'])) {
                $rowData->setId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccessMessage(__('Data Added Successfully.'));
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage("We can\'t submit your request, please try again.");
        }

        $this->_redirect('grid/grid/index');
    }
}
