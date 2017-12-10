<?php

namespace spec\Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter;

use Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\AttributeOperatorMap;
use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Model\AttributeInterface;
use Pim\Component\Catalog\Query\Filter\AttributeFilterInterface;
use Pim\Component\Catalog\Query\Filter\FilterRegistryInterface;
use Pim\Component\Catalog\Repository\AttributeRepositoryInterface;
use Prophecy\Argument;

class AttributeOperatorMapSpec extends ObjectBehavior
{
    function let(
        FilterRegistryInterface $filterRegistry,
        AttributeFilterInterface $filter1,
        AttributeFilterInterface $filter2,
        AttributeRepositoryInterface $attributeRepository,
        AttributeInterface $attribute1,
        AttributeInterface $attribute2,
        AttributeInterface $attribute3
    )
    {
        $filter1->getAttributeTypes()->willReturn(['text', 'bool']);
        $filter1->getOperators()->willReturn(['=', '!=']);

        $filter2->getAttributeTypes()->willReturn(['int']);
        $filter2->getOperators()->willReturn(['>', '<']);

        $filterRegistry->getAttributeFilters()->willReturn([$filter1, $filter2]);

        $attribute1->getCode()->willReturn('sku');
        $attribute1->isLocalizable()->willReturn(false);
        $attribute1->isScopable()->willReturn(false);

        $attribute2->getCode()->willReturn('title');
        $attribute2->isLocalizable()->willReturn(true);
        $attribute2->isScopable()->willReturn(false);

        $attribute3->getCode()->willReturn('size');
        $attribute3->isLocalizable()->willReturn(false);
        $attribute3->isScopable()->willReturn(true);

        $attributeRepository->findAll()->willReturn([$attribute1, $attribute2, $attribute3]);

        $this->beConstructedWith($filterRegistry, $attributeRepository);


    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AttributeOperatorMap::class);
    }

    function it_returns_operartor_list()
    {
        $this->getOperators()->shouldReturn(['=', '!=', '>', '<']);
    }

    function it_returns_attribute_list()
    {
        $this->getAttributes()->shouldReturn(['sku', 'title', 'size']);
    }
}
