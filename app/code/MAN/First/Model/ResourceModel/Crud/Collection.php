<?php

namespace MAN\First\Model\ResourceModel\Crud;

use MAN\First\Model\Crud;
use MAN\First\Model\ResourceModel\Crud as CrudResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Crud::class, CrudResourceModel::class);
    }
}
