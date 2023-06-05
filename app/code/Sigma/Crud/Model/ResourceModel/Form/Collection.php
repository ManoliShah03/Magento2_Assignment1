<?php

namespace Sigma\Crud\Model\ResourceModel\Grid;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Sigma\Crud\Model\Crud;

class Collection extends AbstractCollection
{
    /** @var string  */
    protected $_idFieldName = 'id';

    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            Crud::class,
            \Sigma\Crud\Model\ResourceModel\Crud::class
        );
    }
}
