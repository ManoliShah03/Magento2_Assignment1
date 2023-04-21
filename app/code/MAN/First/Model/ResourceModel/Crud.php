<?php

namespace MAN\First\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Crud extends AbstractDb
{
    const MAIN_TABLE = 'crud';
    const ID_FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
