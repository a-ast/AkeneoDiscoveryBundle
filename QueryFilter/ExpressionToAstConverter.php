<?php

namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter;

use Aa\Bundle\AkeneoQueryBundle\Attribute\AttributePairCollectionBuilder;

class ExpressionToAstConverter
{
    /**
     * @var ExpressionBuilder
     */
    private $expressionBuilder;

    /**
     * @var OperatorToFunction
     */
    private $operatorToFunction;

    /**
     * @var AttributePairCollectionBuilder
     */
    private $attributePairCollectionBuilder;

    public function __construct(
        OperatorToFunction $operatorToFunction,
        ExpressionBuilder $expressionBuilder,
        AttributePairCollectionBuilder $attributePairCollectionBuilder
    )
    {
        $this->expressionBuilder = $expressionBuilder;
        $this->operatorToFunction = $operatorToFunction;
        $this->attributePairCollectionBuilder = $attributePairCollectionBuilder;
    }

    public function convert(string $expression)
    {
        $collection = $this->attributePairCollectionBuilder->build();

        $expression = $this->expressionBuilder->build($expression,
            $this->operatorToFunction->getExpressionFunctionNames(),
            $collection->getExpressionAttributeNames());

        return $expression->getNodes();
    }
}
