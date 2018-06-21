<?php

namespace Aa\Bundle\AkeneoQueryBundle\Attribute;

use Pim\Component\Catalog\Query\Filter\Operators;

class AttributeCollection
{
    /**
     * @var array
     */
    private $items = [];

    public function add(Attribute $pimAttribute)
    {
        $this->items[$pimAttribute->getName()] = $pimAttribute;
    }

    /**
     * @return Attribute[]
     */
    public function getAttributes(): array
    {
        return $this->items;
    }

    /**
     * @return string[]
     */
    public function getExpressionAttributeNames(): array
    {
        return array_keys($this->items);
    }

    // @todo: getExpressionOperators/Functions


}
