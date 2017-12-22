<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\QueryFilter;

use Aa\Bundle\AkeneoQueryBundle\QueryFilter\AttributeOperatorMap;
use Aa\Bundle\AkeneoQueryBundle\QueryFilter\ExpressionToAstConverter;
use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Query\Filter\FilterRegistryInterface;
use Prophecy\Argument;
use Symfony\Component\ExpressionLanguage\Node\Node;

class ExpressionToAstConverterSpec extends ObjectBehavior
{
    function let(AttributeOperatorMap $attributeOperatorMap)
    {
        $attributeOperatorMap->getOperators()->willReturn(['=', '!=']);
        $attributeOperatorMap->getAttributes()->willReturn(['sku', 'size']);

        $this->beConstructedWith($attributeOperatorMap);
    }

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
        $this->shouldThrow('Aa\Bundle\AkeneoQueryBundle\QueryFilter\Exceptions\SyntaxErrorException')->during('convert', ['sku = 123']);
    }
}
