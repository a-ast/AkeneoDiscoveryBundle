<?php

namespace spec\Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\NodeVisitor;

use Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\NodeVisitor\BinaryNodeVisitor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\ExpressionLanguage\Node\BinaryNode;

class BinaryNodeVisitorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BinaryNodeVisitor::class);
    }

    function it_supports_binary_node(BinaryNode $node)
    {
        $this->supports($node)->shouldReturn(true);
    }
}
