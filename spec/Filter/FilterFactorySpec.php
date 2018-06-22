<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\Filter;

use Aa\Bundle\AkeneoQueryBundle\Filter\Filter;
use Aa\Bundle\AkeneoQueryBundle\Filter\FilterFactory;
use Aa\Bundle\AkeneoQueryBundle\QueryFilter\CollectionBuilder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FilterFactorySpec extends ObjectBehavior
{
    function let(CollectionBuilder $operatorToFunction)
    {
        $this->beConstructedWith($operatorToFunction);
        $operatorToFunction->getPimOperator('==')->willReturn('=');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FilterFactory::class);
    }

    function it_creates_filter()
    {
        $this->create('sku', '123', '==', '')->shouldHaveType(Filter::class);
    }

    function it_transforms_operators_to_akeneo_operators()
    {
        $this->create('sku', '123', '==', '')->getOperator()->shouldReturn('=');
    }
}
