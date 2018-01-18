<?php

namespace spec\Aa\Bundle\AkeneoQueryBundle\Attribute;

use Aa\Bundle\AkeneoQueryBundle\Attribute\ExpressionAttribute;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExpressionAttributeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('color', ['==', '!==']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ExpressionAttribute::class);
    }

    function it_returns_name()
    {
        $this->getName()->shouldReturn('color');
    }

    function it_returns_operators()
    {
        $this->getOperators()->shouldReturn(['==', '!==']);
    }
}
