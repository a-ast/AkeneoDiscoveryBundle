<?php

namespace Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter;

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

    public function __construct(AttributeOperatorMap $attributeOperatorMap, ExpressionBuilder $expressionBuilder)
    {
        $this->attributeOperatorMap = $attributeOperatorMap;
        $this->expressionBuilder = $expressionBuilder;
    }

    public function convert(string $expression)
    {
        $expression = $this->expressionBuilder->build($expression,
            $this->attributeOperatorMap->getOperators(),
            $this->attributeOperatorMap->getAttributes());

        return $expression->getNodes();
    }
}
