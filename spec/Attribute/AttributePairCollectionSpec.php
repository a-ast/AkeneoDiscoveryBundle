<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\Attribute;

use Aa\Bundle\AkeneoQueryBundle\Attribute\AttributePairCollection;
use Aa\Bundle\AkeneoQueryBundle\Attribute\ExpressionAttribute;
use Aa\Bundle\AkeneoQueryBundle\Attribute\PimAttribute;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AttributePairCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AttributePairCollection::class);
    }

    function it_adds_pair(PimAttribute $pimAttribute, ExpressionAttribute $expressionAttribute)
    {
        $pimAttribute->getName()->willReturn('color');

        $this->add($pimAttribute, $expressionAttribute);
    }
}
