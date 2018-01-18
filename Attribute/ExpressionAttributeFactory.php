<?php

namespace Aa\Bundle\AkeneoQueryBundle\Attribute;

class ExpressionAttributeFactory
{
    public function createAttributesFromPimAttribute(PimAttribute $pimAttribute)
    {
        // implement name mapping


        return [
            new ExpressionAttribute($pimAttribute->getName(), $pimAttribute->getOperators())
        ];
    }
}
