<?php

namespace spec\Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter;

use Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\ExpressionToAstConverter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\ExpressionLanguage\Node\Node;

class ExpressionToAstConverterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ExpressionToAstConverter::class);
    }

    function it_converts_expression_text_to_expression_ast()
    {
        $this->convert('sku == 123')->shouldHaveType(Node::class);
    }

    function it_throws_exception_if_expreesion_has_syntax_error()
    {
        $this->shouldThrow('Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\Exceptions\SyntaxErrorException')->during('convert', ['sku = 123']);
    }
}
