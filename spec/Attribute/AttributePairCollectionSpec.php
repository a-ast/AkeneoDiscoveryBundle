<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\Attribute;

use Aa\Bundle\AkeneoQueryBundle\Attribute\AttributeCollection;
use Aa\Bundle\AkeneoQueryBundle\Attribute\ExpressionAttribute;
use Aa\Bundle\AkeneoQueryBundle\Attribute\Attribute;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AttributePairCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AttributeCollection::class);
    }

    function it_adds_pair(Attribute $pimAttribute, ExpressionAttribute $expressionAttribute)
    {
        $pimAttribute->getName()->willReturn('color');

        $this->add($pimAttribute, $expressionAttribute);
    }
}
