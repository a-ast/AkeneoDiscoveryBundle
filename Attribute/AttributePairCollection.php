<?php

namespace Aa\Bundle\AkeneoQueryBundle\Attribute;

use ArrayObject;
use Pim\Component\Catalog\Query\Filter\Operators;

class AttributePairCollection
{
    /**
     * @var ArrayObject
     */
    private $items;

    /**
     * @var array
     */
    private $supportedOperarors;

    public function __construct()
    {
        $this->items = new ArrayObject();

        $this->supportedOperarors = [
            Operators::EQUALS => '==',
            Operators::NOT_EQUAL => Operators::NOT_EQUAL,
            Operators::LOWER_THAN => Operators::LOWER_THAN,
            Operators::LOWER_OR_EQUAL_THAN => Operators::LOWER_OR_EQUAL_THAN,
            Operators::GREATER_THAN => Operators::GREATER_THAN,
            Operators::GREATER_OR_EQUAL_THAN => Operators::GREATER_OR_EQUAL_THAN,
            Operators::IN_LIST => strtolower(Operators::IN_LIST),
            Operators::NOT_IN_LIST => strtolower(Operators::NOT_IN_LIST),
        ];
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

    /**
     * @return string[]
     */
    public function getExpressionAttributeNames(): array
    {
        $names = [];

        foreach ($this->getExpressionAttributes() as $expressionAttribute) {
            $names[] = $expressionAttribute->getName();
        }

        return $names;
    }

    // @todo: getExpressionOperators/Functions


}
