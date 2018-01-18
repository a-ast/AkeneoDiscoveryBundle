<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\Attribute;

use Aa\Bundle\AkeneoQueryBundle\Attribute\AttributePairCollectionBuilder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AttributePairCollectionBuilderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AttributePairCollectionBuilder::class);
    }
}
