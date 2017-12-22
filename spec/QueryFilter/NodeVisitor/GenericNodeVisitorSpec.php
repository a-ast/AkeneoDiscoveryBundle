<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor;

use Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor\GenericNodeVisitor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\ExpressionLanguage\Node\BinaryNode;

class GenericNodeVisitorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(GenericNodeVisitor::class);
    }

    function it_gets_filters(BinaryNode $node)
    {
        $this->getFilters($node)->shouldReturn([]);
    }
}
