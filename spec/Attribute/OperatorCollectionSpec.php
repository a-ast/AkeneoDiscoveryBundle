<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\Attribute;

use Aa\Bundle\AkeneoQueryBundle\Attribute\OperatorCollection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OperatorCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(OperatorCollection::class);
    }

    function it_should_return_all_expression_functions()
    {
        $this->add('STARTS WITH');
        $this->add('EMPTY');
        $this->add('CONTAINS');
        $this->add('=');
        $this->add('!=');

        $this->getExpressionFunctions()->shouldReturn(['starts_with', 'empty', 'contains']);
    }

    function it_should_return_expression_functions_by_the_list_of_operators()
    {
        $this->add('STARTS WITH');
        $this->add('EMPTY');
        $this->add('CONTAINS');
        $this->add('=');
        $this->add('!=');

        $this->getExpressionFunctions(['STARTS WITH', 'CONTAINS'])->shouldReturn(['starts_with', 'contains']);
    }

    function it_should_return_all_expression_operators()
    {
        $this->add('=');
        $this->add('!=');
        $this->add('<');

        $this->getExpressionOperators()->shouldReturn(['==', '!=', '<']);
    }

    function it_should_return_expression_operators_by_the_list_of_operators()
    {
        $this->add('=');
        $this->add('!=');
        $this->add('<');

        $this->getExpressionOperators(['=', '<'])->shouldReturn(['==', '<']);
    }
}

