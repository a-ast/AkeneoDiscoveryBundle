<?php

namespace Aa\Bundle\AkeneoQueryBundle\Attribute;

use Pim\Component\Catalog\Query\Filter\Operators;

class OperatorCollection
{
    /**
     * @var array
     */
    private $supportedOperators;

    /**
     * @var array
     */
    private $items = [];

    public function __construct()
    {
        $this->supportedOperators = [
            Operators::EQUALS => '==',
            Operators::NOT_EQUAL => Operators::NOT_EQUAL,
            Operators::LOWER_THAN => Operators::LOWER_THAN,
            Operators::LOWER_OR_EQUAL_THAN => Operators::LOWER_OR_EQUAL_THAN,
            Operators::GREATER_THAN => Operators::GREATER_THAN,
            Operators::GREATER_OR_EQUAL_THAN => Operators::GREATER_OR_EQUAL_THAN,
            Operators::IN_LIST => strtolower(Operators::IN_LIST),
            Operators::NOT_IN_LIST => strtolower(Operators::NOT_IN_LIST),
        ];
    }

    public function add(string $operator)
    {
        if (in_array($operator, $this->items)) {
            return;
        }

        $this->items[] = $operator;
    }

    public function getExpressionFunctionNames(): array
    {
        //return array_values($this->functionNames);
    }

    public function getPimOperator(string $expressionOperator): string
    {
        $functionOperator = array_search($expressionOperator, $this->functionNames);

        if (false !== $functionOperator) {
            return $functionOperator;
        }

        $operator = array_search($expressionOperator, $this->supportedOperators);

        if (false !== $operator) {
            return $operator;
        }

        throw new \Exception(sprintf('Unknown operator %s', $expressionOperator));
    }

//    private function initialize()
//    {
//
//
//        $this->functionNames = [];
//
//        foreach ($this->attributeOperatorMap->getOperators() as $operatorName) {
//            if (isset($this->supportedOperarors[$operatorName])) {
//                continue;
//            }
//
//            $this->functionNames[$operatorName] = str_replace(' ', '_', strtolower($operatorName));
//        }
//    }
}
