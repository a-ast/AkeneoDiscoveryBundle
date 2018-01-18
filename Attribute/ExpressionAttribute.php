<?php

namespace Aa\Bundle\AkeneoQueryBundle\Attribute;

class ExpressionAttribute
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $operators;

    public function __construct(string $name, array $operators)
    {
        $this->name = $name;
        $this->operators = $operators;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOperators()
    {
        return $this->operators;
    }
}
