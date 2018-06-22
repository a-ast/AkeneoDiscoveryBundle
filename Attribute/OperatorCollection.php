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

    public function getExpressionFunctions(array $operators = []): array
    {
        if (0 === count($operators)) {
            $operators = $this->operators;
        }

        $operators = array_diff($operators, array_keys($this->pimToExpressionOperatorMap));

        $functionNames = array_map(function($item) {
            return str_replace(' ', '_', strtolower($item));
        }, $operators);

        return $functionNames;
    }

    public function getExpressionOperators(array $operators = []): array
    {
        if (0 === count($operators)) {
            $operators = $this->operators;
        }

        $expressionOperators = array_filter($this->pimToExpressionOperatorMap,
            function($key) use ($operators) {
                return in_array($key, $operators);
            },
            ARRAY_FILTER_USE_KEY
        );

        return array_values($expressionOperators);
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
