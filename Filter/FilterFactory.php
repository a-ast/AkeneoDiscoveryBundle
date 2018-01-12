<?php

namespace Aa\Bundle\AkeneoQueryBundle\Filter;

use Aa\Bundle\AkeneoQueryBundle\QueryFilter\OperatorToFunction;

class FilterFactory
{
    /**
     * @var OperatorToFunction
     */
    private $operatorToFunction;

    public function __construct(OperatorToFunction $operatorToFunction)
    {
        $this->operatorToFunction = $operatorToFunction;
    }

    public function create(string $field, string $value, string $operator, string $context)
    {
        $pimOperator = $this->operatorToFunction->getPimOperator($operator);

        return new Filter($field, $value, $pimOperator, $context);
    }
}
