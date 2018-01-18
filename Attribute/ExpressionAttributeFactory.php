<?php

namespace Aa\Bundle\AkeneoQueryBundle\Attribute;

class ExpressionAttributeFactory
{
    public function createAttributesFromPimAttribute(PimAttribute $pimAttribute)
    {
        // implement name mapping
        $attributes = [];
        $attributes[] = new ExpressionAttribute($pimAttribute->getName(), $pimAttribute->getOperators());

        if ($pimAttribute->isLocalizable()) {
            $attributes[] = new ExpressionAttribute($pimAttribute->getName().'.locale', ['=']);
        }

        if ($pimAttribute->isScopable()) {
            $attributes[] = new ExpressionAttribute($pimAttribute->getName().'.scope', ['=']);
        }

        return $attributes;
    }
}
