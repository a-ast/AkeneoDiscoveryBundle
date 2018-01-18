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

    public function add(PimAttribute $pimAttribute, array $expressionAttributes)
    {
        $this->items[$pimAttribute->getName()] = [
            $pimAttribute,
            $expressionAttributes,
        ];
    }

    /**
     * @return ExpressionAttribute[]
     */
    public function getExpressionAttributes(): array
    {
        $attributes = [];

        foreach ($this->items as $item) {
            $attributes = array_merge($attributes, $item[1]);
        }

        return $attributes;
    }

    // @todo: getExpressionOperators/Functions
}
