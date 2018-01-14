<?php

namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter;

use Pim\Component\Catalog\Query\Filter\Operators;

class OperatorToFunction
{
    /**
     * @var AttributeOperatorMap
     */
    private $attributeOperatorMap;

    /**
     * @var array
     */
    private $supportedOperarors;

    /**
     * @var array
     */
    private $functionNames;

    public function __construct(AttributeOperatorMap $attributeOperatorMap)
    {
        $this->attributeOperatorMap = $attributeOperatorMap;
    }

    public function getExpressionFunctionNames(): array
    {
        $this->initialize();

        return array_values($this->functionNames);
    }

    public function getPimOperator(string $expressionOperator)
    {
        $this->initialize();

        $functionOperator = array_search($expressionOperator, $this->functionNames);

        if (false !== $functionOperator) {
            return $functionOperator;
        }

        $operator = array_search($expressionOperator, $this->supportedOperarors);

        if (false !== $operator) {
            return $operator;
        }

        throw new \Exception(sprintf('Unknown operator %s', $expressionOperator));
    }

    private function initialize()
    {
        $this->supportedOperarors = [
            Operators::EQUALS => '==',
            Operators::NOT_EQUAL => Operators::NOT_EQUAL,
            Operators::LOWER_THAN => Operators::LOWER_THAN,
            Operators::LOWER_OR_EQUAL_THAN => Operators::LOWER_OR_EQUAL_THAN,
            Operators::GREATER_THAN => Operators::GREATER_THAN,
            Operators::GREATER_OR_EQUAL_THAN => Operators::GREATER_OR_EQUAL_THAN,
            Operators::IN_LIST => strtolower(Operators::IN_LIST),
            Operators::NOT_IN_LIST => strtolower(Operators::NOT_IN_LIST),
        ];

        $this->functionNames = [];

        foreach ($this->attributeOperatorMap->getOperators() as $operatorName) {
            if (isset($this->supportedOperarors[$operatorName])) {
                continue;
            }

            $this->functionNames[$operatorName] = str_replace(' ', '_', strtolower($operatorName));
        }
    }
}