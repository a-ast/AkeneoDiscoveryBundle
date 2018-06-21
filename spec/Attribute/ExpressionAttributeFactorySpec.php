<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\Attribute;

use Aa\Bundle\AkeneoQueryBundle\Attribute\ExpressionAttributeFactory;
use Aa\Bundle\AkeneoQueryBundle\Attribute\Attribute;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExpressionAttributeFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ExpressionAttributeFactory::class);
    }

    function it_creates_expression_attribute(Attribute $pimAttribute)
    {
        $pimAttribute->getName()->willReturn('color');
        $pimAttribute->getOperators()->willReturn(['=']);

        $this->createAttributesFromPimAttribute($pimAttribute);
    }
}
