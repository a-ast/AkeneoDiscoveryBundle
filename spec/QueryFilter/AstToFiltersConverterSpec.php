<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\QueryFilter;

use Aa\Bundle\AkeneoQueryBundle\QueryFilter\AstToFiltersConverter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\ExpressionLanguage\Node\Node;

class AstToFiltersConverterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AstToFiltersConverter::class);
    }

    function it_converts_ast_node_to_filters(Node $node)
    {
        $this->connvert($node);
    }
}
