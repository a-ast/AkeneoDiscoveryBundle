<?php

namespace Aa\Bundle\AkeneoQueryBundle\Attribute;

use ArrayObject;

class AttributePairCollection
{
    /**
     * @var ArrayObject
     */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayObject();
    }

    public function add(PimAttribute $pimAttribute, ExpressionAttribute $expressionAttribute)
    {
        $this->items[$pimAttribute->getName()] = [
            $pimAttribute,
            $expressionAttribute,
        ];
    }
}
