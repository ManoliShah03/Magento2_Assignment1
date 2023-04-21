<?php

namespace MAN\First\Model;

use Magento\Framework\Model\AbstractModel;

class Crud extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\MAN\First\Model\ResourceModel\Crud::class);
    }
}


