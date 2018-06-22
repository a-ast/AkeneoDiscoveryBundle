<?php

namespace Aa\Bundle\AkeneoQueryBundle\Attribute;

use Pim\Component\Catalog\Query\Filter\Operators;

class OperatorCollection
{
    /**
     * @var array
     */
    private $pimToExpressionOperatorMap;

    /**
     * @var array
     */
    private $operators = [];

    public function __construct()
    {
        $this->pimToExpressionOperatorMap = [
            Operators::EQUALS => '==',
            Operators::NOT_EQUAL => '!=',
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
        if (in_array($operator, $this->operators)) {
            return;
        }

        $this->operators[] = $operator;
    }

    public function getExpressionFunctions(): array
    {
        $functionNames = [];

        foreach ($this->operators as $item) {
            if (isset($this->pimToExpressionOperatorMap[$item])) {
                continue;
            }

            $functionNames[] = str_replace(' ', '_', strtolower($item));
        }

        return $functionNames;
    }

    public function getExpressionOperators(): array
    {
        return array_values($this->operators);
    }

    public function getOperatorByExpressionOperator(string $expressionOperator): string
    {
        $key = array_search($expressionOperator, $this->pimToExpressionOperatorMap);

        if (false !== $key) {
            return $key;
        }

        $operator = str_replace('_', ' ', strtoupper($expressionOperator));

        $key = array_search($operator, $this->pimToExpressionOperatorMap);

        if (false !== $key) {
            return $this->operators[$key];
        }

        throw new \Exception('Unknown operator '.$operator);
    }
}
