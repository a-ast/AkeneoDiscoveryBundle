<?php

namespace spec\Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\NodeVisitor;

use Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\NodeVisitor\NameNodeVisitor;
use Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\NodeVisitor\NodeVisitorFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\ExpressionLanguage\Node\NameNode;

class NodeVisitorFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(NodeVisitorFactory::class);
    }

    function it_creates_name_node_visitor(NameNode $node)
    {
        $this->createVisitor($node)->shouldHaveType(NameNodeVisitor::class);
    }
}
