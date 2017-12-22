<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor;

use Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor\NameFilterNodeVisitor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\ExpressionLanguage\Node\NameNode;

class NameNodeVisitorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(NameFilterNodeVisitor::class);
    }

    function it_supports_name_node(NameNode $node)
    {
        $this->supports($node)->shouldReturn(true);
    }

    function it_returns_name(NameNode $node)
    {
        $node->attributes = ['name' => 'color'];

        $this->visit($node)->shouldReturn('color');
    }
}
