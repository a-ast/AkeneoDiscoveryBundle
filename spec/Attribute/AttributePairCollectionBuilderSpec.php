<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\Attribute;

use Aa\Bundle\AkeneoQueryBundle\Attribute\AttributePairCollection;
use Aa\Bundle\AkeneoQueryBundle\Attribute\AttributePairCollectionBuilder;
use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Query\Filter\FilterRegistryInterface;
use Pim\Component\Catalog\Repository\AttributeRepositoryInterface;
use Prophecy\Argument;

class AttributePairCollectionBuilderSpec extends ObjectBehavior
{
    public function let(FilterRegistryInterface $filterRegistry, AttributeRepositoryInterface $attributeRepository)
    {
        $this->beConstructedWith($filterRegistry, $attributeRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AttributePairCollectionBuilder::class);
    }

    function it_builds_the_collection(AttributePairCollection $collection)
    {
        $this->build($collection);
    }
}
