<?php

namespace Aa\Bundle\AkeneoQueryBundle\Attribute;

use Pim\Component\Catalog\Model\AttributeInterface;
use Pim\Component\Catalog\Query\Filter\FilterInterface;

class AttributeFactory
{
    public function create(AttributeInterface $attribute, FilterInterface $attributeFilter)
    {
        return new Attribute(
            $attribute->getCode(),
            $attribute->isLocalizable(),
            $attribute->isScopable(),
            $attribute->getType(),
            $attributeFilter->getOperators()
        );
    }
}
