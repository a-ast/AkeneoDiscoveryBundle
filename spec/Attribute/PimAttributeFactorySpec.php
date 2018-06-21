<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\Attribute;

use Aa\Bundle\AkeneoQueryBundle\Attribute\AttributeFactory;
use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Model\AttributeInterface;
use Pim\Component\Catalog\Query\Filter\FilterInterface;
use Prophecy\Argument;

class PimAttributeFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AttributeFactory::class);
    }

    function it_creates_pim_attribute(AttributeInterface $attribute, FilterInterface $attributeFilter)
    {
        $this->create($attribute, $attributeFilter);
    }
}
