<?php

namespace MAN\First\Block;

use MAN\First\Model\ResourceModel\Crud\Collection;
use Magento\Framework\View\Element\Template;

class First extends Template
{
    private $collection;

    public function __construct(
        Template\Context $context,
        Collection $collection,
        array $data = []
    ) {
        $this->collection = $collection;
        parent::__construct($context, $data);
    }


public function getAllFormData()
{
    return $this->collection;
}

public function getFirst()
{
    return'crud operation';
}}

