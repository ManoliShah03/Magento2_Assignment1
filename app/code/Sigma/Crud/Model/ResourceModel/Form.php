<?php

namespace Sigma\Crud\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Crud extends AbstractDb
{

    /** @var main table name */
    const MAIN_TABLE = 'sigma_crud_assignment_record';

    /** @var main table primary key field */
    const ID_FIELD_NAME = 'id';

    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    public function __construct(
        Context $context,
        private DateTime $time,
        $resourcePrefix = null
    )
    {
        parent::__construct($context, $resourcePrefix);
    }

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
