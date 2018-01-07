<?php

namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter;

class ExpressionToAstConverter
{
    /**
     * @var AttributeOperatorMap
     */
    private $attributeOperatorMap;

    /**
     * @var ExpressionBuilder
     */
    private $expressionBuilder;

    /**
     * @var OperatorToFunction
     */
    private $operatorToFunction;

    public function __construct(AttributeOperatorMap $attributeOperatorMap, OperatorToFunction $operatorToFunction, ExpressionBuilder $expressionBuilder)
    {
        $this->attributeOperatorMap = $attributeOperatorMap;
        $this->expressionBuilder = $expressionBuilder;
        $this->operatorToFunction = $operatorToFunction;
    }

    public function convert(string $expression)
    {
        $expression = $this->expressionBuilder->build($expression,
            $this->operatorToFunction->getExpressionFunctionNames(),
            $this->attributeOperatorMap->getAttributes());

        return $expression->getNodes();
    }
}
